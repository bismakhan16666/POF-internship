<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $course;

    public function setUp(): void
    {
        parent::setUp();

        // Create a course first
        $this->course = Course::create([
            'name' => 'Test Course',
            'code' => 'TEST-101',
            'credit_hours' => 3,
            'description' => 'Test description',
        ]);

        // Create user and get token
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        $this->token = $user->createToken('auth_token')->plainTextToken;
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->post('/api/register', [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['token', 'user']
        ]);
    }

    /** @test */
    public function user_can_login()
    {
        $response = $this->post('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['token', 'user']
        ]);
    }

    /** @test */
    public function user_can_get_students()
    {
        $response = $this->get('/api/students', [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_student()
    {
        $response = $this->post('/api/students', [
            'name' => 'Test Student',
            'email' => 'teststudent@example.com',
            'age' => 25,
            'course_id' => $this->course->id,
        ], [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['id', 'name', 'email']
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_access_protected_routes()
    {
        $response = $this->get('/api/students', [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    /** @test */
    public function user_can_enroll_in_course()
    {
        // Create student first
        $student = Student::create([
            'name' => 'Enroll Test',
            'email' => 'enroll@example.com',
            'age' => 22,
            'course_id' => $this->course->id,
        ]);

        $response = $this->post("/api/students/{$student->id}/enroll/{$this->course->id}", [], [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Student enrolled successfully'
        ]);
    }

    /** @test */
    public function user_can_unenroll_from_course()
    {
        // Create student
        $student = Student::create([
            'name' => 'Unenroll Test',
            'email' => 'unenroll@example.com',
            'age' => 22,
            'course_id' => $this->course->id,
        ]);

        // Enroll first
        $student->courses()->attach($this->course->id, [
            'enrollment_date' => now()->format('Y-m-d')
        ]);

        $response = $this->delete("/api/students/{$student->id}/unenroll/{$this->course->id}", [], [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Student unenrolled successfully'
        ]);
    }
}