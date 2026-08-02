<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'avatar' => $this->avatar ? asset('storage/' . $this->avatar) : null,
            'courses' => CourseResource::collection($this->whenLoaded('courses')),
            'total_credit_hours' => $this->total_credit_hours,
            'enrolled_courses_count' => $this->courses()->count(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}