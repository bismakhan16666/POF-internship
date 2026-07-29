<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 3 - PHP OOP Exercises</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            padding: 40px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
        }

        .header h1 span {
            background: rgba(255,255,255,0.2);
            padding: 5px 20px;
            border-radius: 50px;
            display: inline-block;
        }

        .header p {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .header .badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 5px 25px;
            border-radius: 50px;
            color: #fff;
            font-size: 0.9rem;
            margin-top: 15px;
            border: 1px solid rgba(255,255,255,0.3);
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            border-color: rgba(255,255,255,0.2);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title .number {
            background: linear-gradient(135deg, #667eea, #764ba2);
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
        }

        .card-content {
            color: rgba(255,255,255,0.85);
            font-size: 1rem;
            line-height: 1.8;
        }

        .card-content code {
            background: rgba(255,255,255,0.08);
            padding: 2px 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            color: #a8b5ff;
            font-size: 0.9rem;
        }

        .two-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .item-box {
            background: rgba(255,255,255,0.03);
            padding: 18px;
            border-radius: 12px;
        }

        .item-box .item-title {
            color: #a8b5ff;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .item-box .key-value {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .item-box .key-value .key {
            color: rgba(255,255,255,0.5);
        }

        .item-box .key-value .val {
            color: #fff;
        }

        .tag {
            display: inline-block;
            padding: 3px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 2px 4px 2px 0;
        }

        .tag-primary { background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; }
        .tag-success { background: linear-gradient(135deg, #11998e, #38ef7d); color: #fff; }
        .tag-warning { background: linear-gradient(135deg, #f093fb, #f5576c); color: #fff; }

        .info-box {
            background: rgba(255,255,255,0.03);
            padding: 15px 20px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            margin: 8px 0;
            font-size: 0.95rem;
        }

        .info-box-success { border-left-color: #38ef7d; }
        .info-box-info { border-left-color: #4facfe; }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        .text-center { text-align: center; }
        .text-muted { color: rgba(255,255,255,0.3); }
        .mt-15 { margin-top: 15px; }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        @media (max-width: 600px) {
            .header h1 {
                font-size: 1.8rem;
            }
            .card {
                padding: 20px;
            }
            .two-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- ========== HEADER ========== -->
    <div class="header fade-in">
        <h1>Day 3 <span>PHP OOP Exercises</span></h1>
        <p>Classes &bull; Objects &bull; Inheritance &bull; Traits &bull; Namespaces</p>
        <span class="badge">PHP &amp; Laravel Internship Program</span>
    </div>

    <?php
    // ============================================================
    // 1. CLASSES & OBJECTS (Schedule Topic 1)
    // ============================================================
    ?>
    <div class="card fade-in delay-1">
        <div class="card-title">
            <span class="number">1</span> Classes &amp; Objects
        </div>
        <div class="card-content">

            <?php
            // Class define karein
            class Student {
                public $name;
                public $age;
                public $course;
                
                public function introduce() {
                    return "Hello! My name is " . $this->name . ". I am " . $this->age . " years old.";
                }
            }

            // Object create karein (Class ka instance)
            $student1 = new Student();
            $student1->name = "Bisma Khan";
            $student1->age = 22;
            $student1->course = "Laravel Internship";

            $student2 = new Student();
            $student2->name = "Ahmed Ali";
            $student2->age = 24;
            $student2->course = "Web Development";
            ?>

            <div class="two-grid">
                <div class="item-box">
                    <div class="item-title">Student 1 (Object)</div>
                    <div class="key-value"><span class="key">Name</span><span class="val"><?php echo $student1->name; ?></span></div>
                    <div class="key-value"><span class="key">Age</span><span class="val"><?php echo $student1->age; ?></span></div>
                    <div class="key-value"><span class="key">Course</span><span class="val"><?php echo $student1->course; ?></span></div>
                    <div class="key-value"><span class="key">Introduce</span><span class="val"><?php echo $student1->introduce(); ?></span></div>
                </div>
                <div class="item-box">
                    <div class="item-title">Student 2 (Object)</div>
                    <div class="key-value"><span class="key">Name</span><span class="val"><?php echo $student2->name; ?></span></div>
                    <div class="key-value"><span class="key">Age</span><span class="val"><?php echo $student2->age; ?></span></div>
                    <div class="key-value"><span class="key">Course</span><span class="val"><?php echo $student2->course; ?></span></div>
                    <div class="key-value"><span class="key">Introduce</span><span class="val"><?php echo $student2->introduce(); ?></span></div>
                </div>
            </div>

            <div class="info-box info-box-info mt-15">
                <strong>Concept:</strong> <span class="tag tag-primary">Class</span> is a blueprint. 
                <span class="tag tag-success">Object</span> is an instance of a class.
            </div>
        </div>
    </div>

    <?php
    // ============================================================
    // 2. INHERITANCE (Schedule Topic 2)
    // ============================================================
    ?>
    <div class="card fade-in delay-2">
        <div class="card-title">
            <span class="number">2</span> Inheritance
        </div>
        <div class="card-content">

            <?php
            // Parent Class
            class Person {
                protected $name;
                protected $age;
                
                public function __construct($name, $age) {
                    $this->name = $name;
                    $this->age = $age;
                }
                
                public function introduce() {
                    return "My name is " . $this->name . ". I am " . $this->age . " years old.";
                }
            }

            // Child Class (Inherits from Person)
            class Employee extends Person {
                private $employee_id;
                private $salary;
                
                public function __construct($name, $age, $employee_id, $salary) {
                    parent::__construct($name, $age);
                    $this->employee_id = $employee_id;
                    $this->salary = $salary;
                }
                
                public function introduce() {
                    return parent::introduce() . " I work as an employee. My ID is " . $this->employee_id . ".";
                }
            }

            // Child Class (Inherits from Employee)
            class Manager extends Employee {
                private $department;
                
                public function __construct($name, $age, $employee_id, $salary, $department) {
                    parent::__construct($name, $age, $employee_id, $salary);
                    $this->department = $department;
                }
                
                public function introduce() {
                    return parent::introduce() . " I manage the " . $this->department . " department.";
                }
            }

            $person = new Person("Ali", 30);
            $employee = new Employee("Ahmed", 25, "EMP001", 50000);
            $manager = new Manager("Fatima", 35, "MGR001", 80000, "IT");
            ?>

            <div class="two-grid">
                <div class="item-box">
                    <div class="item-title">Person (Parent Class)</div>
                    <div class="key-value"><span class="key">Introduce</span><span class="val"><?php echo $person->introduce(); ?></span></div>
                </div>
                <div class="item-box">
                    <div class="item-title">Employee (Child of Person)</div>
                    <div class="key-value"><span class="key">Introduce</span><span class="val"><?php echo $employee->introduce(); ?></span></div>
                </div>
                <div class="item-box">
                    <div class="item-title">Manager (Child of Employee)</div>
                    <div class="key-value"><span class="key">Introduce</span><span class="val"><?php echo $manager->introduce(); ?></span></div>
                </div>
            </div>

            <div class="info-box info-box-info mt-15">
                <strong>Concept:</strong> Child class inherits from parent class using <code>extends</code> keyword.
                <span class="tag tag-primary">parent::</span> calls parent class method.
            </div>
        </div>
    </div>

    <?php
    // ============================================================
    // 3. TRAITS (Schedule Topic 3)
    // ============================================================
    ?>
    <div class="card fade-in delay-3">
        <div class="card-title">
            <span class="number">3</span> Traits (Code Reusability)
        </div>
        <div class="card-content">

            <?php
            // Trait banayein
            trait Logger {
                public function log($message) {
                    echo "<span class='tag tag-primary'>Log:</span> " . date('Y-m-d H:i:s') . " - " . $message . "<br>";
                }
            }

            trait Timestamp {
                public function getTimestamp() {
                    return date('Y-m-d H:i:s');
                }
            }

            // Class jo Trait use kare
            class User {
                use Logger, Timestamp; // Multiple traits use kar rahe hain
                private $name;
                
                public function __construct($name) {
                    $this->name = $name;
                    $this->log("User created: " . $name);
                }
                
                public function getName() {
                    return $this->name;
                }
            }

            class Product {
                use Logger; // Sirf Logger trait use kar raha hai
                private $product_name;
                private $price;
                
                public function __construct($product_name, $price) {
                    $this->product_name = $product_name;
                    $this->price = $price;
                    $this->log("Product created: " . $product_name);
                }
                
                public function displayProduct() {
                    return "Product: " . $this->product_name . ", Price: $" . $this->price;
                }
            }

            $user = new User("Bisma Khan");
            $product = new Product("Laptop", 999);
            ?>

            <div class="two-grid">
                <div class="item-box">
                    <div class="item-title">User (uses Logger + Timestamp)</div>
                    <div class="key-value"><span class="key">Name</span><span class="val"><?php echo $user->getName(); ?></span></div>
                    <div class="key-value"><span class="key">Timestamp</span><span class="val"><?php echo $user->getTimestamp(); ?></span></div>
                </div>
                <div class="item-box">
                    <div class="item-title">Product (uses Logger)</div>
                    <div class="key-value"><span class="key">Info</span><span class="val"><?php echo $product->displayProduct(); ?></span></div>
                </div>
            </div>

            <div class="info-box info-box-success mt-15">
                <strong>Concept:</strong> Traits allow code reuse across multiple classes using <code>use</code> keyword.
            </div>
        </div>
    </div>

    <?php
    // ============================================================
    // 4. NAMESPACES (Schedule Topic 4)
    // ============================================================
    ?>
    <div class="card fade-in delay-4">
        <div class="card-title">
            <span class="number">4</span> Namespaces
        </div>
        <div class="card-content">

            <?php
            // Namespace declare karein (PHP mein pehli line par hona chahiye)
            // Isliye hum alag approach use kar rahe hain
            
            // Using anonymous classes to demonstrate namespace concept
            $user = new class("Bisma Khan") {
                private $name;
                public function __construct($name) { $this->name = $name; }
                public function getName() { return $this->name; }
            };
            
            $controller = new class() {
                public function showUser($user) {
                    return "User from Controller: " . $user->getName();
                }
            };
            
            $view = new class() {
                public function display($controller, $user) {
                    return $controller->showUser($user);
                }
            };
            
            $result = $view->display($controller, $user);
            ?>

            <div class="item-box" style="text-align:center;">
                <div class="item-title">Namespaces Example</div>
                <div class="key-value">
                    <span class="key">Result</span>
                    <span class="val"><?php echo $result; ?></span>
                </div>
            </div>

            <div class="info-box info-box-success mt-15">
                <strong>Concept:</strong> Namespaces organize code and prevent name conflicts. 
                <span class="tag tag-primary">namespace</span> keyword defines a namespace.
            </div>
        </div>
    </div>

    <!-- ========== FOOTER ========== -->
    <div class="text-center" style="padding:30px 0 10px; border-top:1px solid rgba(255,255,255,0.05); margin-top:20px;">
        <span class="text-muted" style="font-size:0.85rem;">Day 3 - PHP OOP Exercises &bull; PHP &amp; Laravel Internship Program</span>
    </div>

</div>

</body>
</html>