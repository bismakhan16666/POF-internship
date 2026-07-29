<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 2 - PHP Exercises</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ========== RESET & BASE ========== */
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

        /* ========== HEADER ========== */
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

        /* ========== CARDS ========== */
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

        /* ========== TABLES ========== */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.03);
        }

        table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            padding: 14px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.85);
        }

        table tr:hover td {
            background: rgba(255,255,255,0.05);
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* ========== BADGES / TAGS ========== */
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
        .tag-info { background: linear-gradient(135deg, #4facfe, #00f2fe); color: #fff; }

        /* ========== VALUE BOXES ========== */
        .value-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }

        .value-box {
            background: rgba(255,255,255,0.05);
            padding: 12px 18px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
            text-align: center;
            transition: all 0.3s ease;
        }

        .value-box:hover {
            background: rgba(255,255,255,0.1);
            transform: scale(1.02);
        }

        .value-box .label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,255,0.4);
        }

        .value-box .value {
            font-size: 1.4rem;
            font-weight: 600;
            color: #fff;
            margin-top: 4px;
        }

        /* ========== RESULTS / OUTPUT ========== */
        .result {
            background: rgba(255,255,255,0.03);
            padding: 15px 20px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            margin: 8px 0;
            font-size: 0.95rem;
        }

        .result-success { border-left-color: #38ef7d; }
        .result-warning { border-left-color: #f5576c; }
        .result-info { border-left-color: #4facfe; }

        /* ========== GRID FOR LOOPS ========== */
        .loop-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .loop-box {
            background: rgba(255,255,255,0.03);
            padding: 18px;
            border-radius: 12px;
        }

        .loop-box .loop-title {
            color: #a8b5ff;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .loop-box .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        /* ========== ARRAY GRID ========== */
        .array-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .array-box {
            background: rgba(255,255,255,0.03);
            padding: 18px;
            border-radius: 12px;
        }

        .array-box .array-title {
            color: #a8b5ff;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .array-box .key-value {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .array-box .key-value .key {
            color: rgba(255,255,255,0.5);
        }

        .array-box .key-value .val {
            color: #fff;
        }

        /* ========== FUNCTION GRID ========== */
        .function-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
        }

        /* ========== STRING GRID ========== */
        .string-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
        }

        .string-box {
            background: rgba(255,255,255,0.05);
            padding: 12px 18px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
            text-align: center;
            transition: all 0.3s ease;
        }

        .string-box:hover {
            background: rgba(255,255,255,0.1);
            transform: scale(1.02);
        }

        .string-box .s-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,255,0.4);
        }

        .string-box .s-value {
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-top: 4px;
            word-break: break-word;
        }

        /* ========== ANIMATIONS ========== */
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
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
        .delay-7 { animation-delay: 0.7s; }

        /* ========== SCROLLBAR ========== */
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

        /* ========== TEXT CENTER ========== */
        .text-center {
            text-align: center;
        }

        .text-muted {
            color: rgba(255,255,255,0.3);
        }

        .mt-15 { margin-top: 15px; }
        .mt-10 { margin-top: 10px; }
        .mb-15 { margin-bottom: 15px; }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 600px) {
            .header h1 {
                font-size: 1.8rem;
            }
            .card {
                padding: 20px;
            }
            .value-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .loop-grid {
                grid-template-columns: 1fr;
            }
            .array-grid {
                grid-template-columns: 1fr;
            }
            .function-grid {
                grid-template-columns: 1fr 1fr;
            }
            .string-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- ========== HEADER ========== -->
    <div class="header fade-in">
        <h1>Day 2 <span>PHP Exercises</span></h1>
        <p>Variables &bull; Operators &bull; Conditions &bull; Loops &bull; Arrays &bull; Functions</p>
        <span class="badge">PHP &amp; Laravel Internship Program</span>
    </div>

    <?php
    // ============================================================
    // 1. VARIABLES & DATA TYPES
    // ============================================================
    ?>
    <div class="card fade-in delay-1">
        <div class="card-title">
            <span class="number">1</span> Variables &amp; Data Types
        </div>
        <div class="card-content">

            <?php
            $name = "Bisma Khan";
            $age = 22;
            $height = 5.9;
            $is_student = true;
            $hobbies = ["Reading", "Coding", "Gaming"];
            $empty_value = null;
            ?>

            <div class="value-grid">
                <div class="value-box">
                    <div class="label">Name</div>
                    <div class="value"><?php echo $name; ?></div>
                </div>
                <div class="value-box">
                    <div class="label">Age</div>
                    <div class="value"><?php echo $age; ?> years</div>
                </div>
                <div class="value-box">
                    <div class="label">Height</div>
                    <div class="value"><?php echo $height; ?> ft</div>
                </div>
                <div class="value-box">
                    <div class="label">Student</div>
                    <div class="value"><?php echo $is_student ? 'Yes' : 'No'; ?></div>
                </div>
                <div class="value-box">
                    <div class="label">Hobbies</div>
                    <div class="value" style="font-size:0.9rem;"><?php echo implode(' &bull; ', $hobbies); ?></div>
                </div>
                <div class="value-box">
                    <div class="label">NULL Value</div>
                    <div class="value" style="font-size:0.9rem;"><?php echo $empty_value === null ? 'NULL' : 'Not NULL'; ?></div>
                </div>
            </div>

            <div class="result result-info mt-15">
                <strong>Data Types:</strong> String, Integer, Float, Boolean, Array, NULL
            </div>
        </div>
    </div>

    <?php
    // ============================================================
    // 2. OPERATORS
    // ============================================================
    ?>
    <div class="card fade-in delay-2">
        <div class="card-title">
            <span class="number">2</span> Operators
        </div>
        <div class="card-content">

            <?php
            $a = 20;
            $b = 5;
            ?>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap:12px; margin-bottom:15px;">
                <div class="value-box">
                    <div class="label">Addition</div>
                    <div class="value"><?php echo $a + $b; ?></div>
                </div>
                <div class="value-box">
                    <div class="label">Subtraction</div>
                    <div class="value"><?php echo $a - $b; ?></div>
                </div>
                <div class="value-box">
                    <div class="label">Multiplication</div>
                    <div class="value"><?php echo $a * $b; ?></div>
                </div>
                <div class="value-box">
                    <div class="label">Division</div>
                    <div class="value"><?php echo $a / $b; ?></div>
                </div>
                <div class="value-box">
                    <div class="label">Modulus</div>
                    <div class="value"><?php echo $a % $b; ?></div>
                </div>
            </div>

            <div style="display:flex; flex-wrap:wrap; gap:10px;">
                <span class="tag tag-primary"><?php echo $a; ?> == <?php echo $b; ?> &rarr; <?php echo $a == $b ? 'True' : 'False'; ?></span>
                <span class="tag tag-success"><?php echo $a; ?> &gt; <?php echo $b; ?> &rarr; <?php echo $a > $b ? 'True' : 'False'; ?></span>
                <span class="tag tag-warning"><?php echo $a; ?> &lt; <?php echo $b; ?> &rarr; <?php echo $a < $b ? 'True' : 'False'; ?></span>
                <span class="tag tag-info"><?php echo $a; ?> != <?php echo $b; ?> &rarr; <?php echo $a != $b ? 'True' : 'False'; ?></span>
            </div>

            <div class="result result-success mt-15">
                <strong>Logical:</strong> Logged In: <?php echo true ? 'Yes' : 'No'; ?> &nbsp;|&nbsp; Admin: <?php echo false ? 'Yes' : 'No'; ?>
            </div>
        </div>
    </div>

    <?php
    // ============================================================
    // 3. CONDITIONS (If-Else)
    // ============================================================
    ?>
    <div class="card fade-in delay-3">
        <div class="card-title">
            <span class="number">3</span> Conditions (If-Else)
        </div>
        <div class="card-content">

            <?php
            $score = 85;
            $age = 19;

            if ($score >= 80) {
                $grade = 'A+';
                $grade_color = 'tag-success';
            } elseif ($score >= 70) {
                $grade = 'A';
                $grade_color = 'tag-primary';
            } elseif ($score >= 60) {
                $grade = 'B';
                $grade_color = 'tag-info';
            } elseif ($score >= 50) {
                $grade = 'C';
                $grade_color = 'tag-warning';
            } else {
                $grade = 'F';
                $grade_color = 'tag-warning';
            }
            ?>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap:15px;">
                <div class="value-box">
                    <div class="label">Score</div>
                    <div class="value"><?php echo $score; ?>%</div>
                </div>
                <div class="value-box">
                    <div class="label">Grade</div>
                    <div class="value"><span class="tag <?php echo $grade_color; ?>"><?php echo $grade; ?></span></div>
                </div>
                <div class="value-box">
                    <div class="label">Voting Status</div>
                    <div class="value" style="font-size:1rem;"><?php echo $age >= 18 ? 'Eligible' : 'Not Eligible'; ?></div>
                </div>
            </div>

            <div class="result result-info mt-15">
                <strong>Condition:</strong> Age = <?php echo $age; ?> &rarr; 
                <?php echo $age >= 18 ? 'You are <strong style="color:#38ef7d;">eligible</strong> to vote.' : 'You are <strong style="color:#f5576c;">not eligible</strong> to vote.'; ?>
            </div>
        </div>
    </div>

    <?php
    // ============================================================
    // 4. LOOPS
    // ============================================================
    ?>
    <div class="card fade-in delay-4">
        <div class="card-title">
            <span class="number">4</span> Loops
        </div>
        <div class="card-content">

            <div class="loop-grid">

                <div class="loop-box">
                    <div class="loop-title">For Loop (1 to 10)</div>
                    <div class="tags">
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                            <span class="tag tag-primary"><?php echo $i; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="loop-box">
                    <div class="loop-title">Even Numbers (2 to 20)</div>
                    <div class="tags">
                        <?php for ($i = 2; $i <= 20; $i += 2) { ?>
                            <span class="tag tag-success"><?php echo $i; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="loop-box">
                    <div class="loop-title">While Loop (Countdown 5 to 1)</div>
                    <div class="tags">
                        <?php $count = 5; while ($count >= 1) { ?>
                            <span class="tag tag-warning"><?php echo $count; ?></span>
                        <?php $count--; } ?>
                    </div>
                </div>

                <div class="loop-box">
                    <div class="loop-title">Foreach Loop (Students)</div>
                    <div class="tags">
                        <?php $students = ["Ali", "Ahmed", "Fatima", "Hassan", "Ayesha"]; ?>
                        <?php foreach ($students as $student) { ?>
                            <span class="tag tag-info"><?php echo $student; ?></span>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <?php
    // ============================================================
    // 5. ARRAYS
    // ============================================================
    ?>
    <div class="card fade-in delay-5">
        <div class="card-title">
            <span class="number">5</span> Arrays
        </div>
        <div class="card-content">

            <?php
            $fruits = ["Apple", "Banana", "Orange", "Mango", "Grapes"];
            
            $student = [
                "name" => "Bisma Khan",
                "age" => 22,
                "city" => "Rawalpindi",
                "course" => "Laravel Internship"
            ];

            $students_data = [
                ["id" => 1, "name" => "Ali", "grade" => "A"],
                ["id" => 2, "name" => "Ahmed", "grade" => "B"],
                ["id" => 3, "name" => "Fatima", "grade" => "A+"]
            ];
            ?>

            <div class="array-grid">

                <div class="array-box">
                    <div class="array-title">Indexed Array</div>
                    <div style="display:flex; flex-wrap:wrap; gap:6px;">
                        <?php foreach ($fruits as $fruit) { ?>
                            <span class="tag tag-primary"><?php echo $fruit; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="array-box">
                    <div class="array-title">Associative Array</div>
                    <?php foreach ($student as $key => $value) { ?>
                        <div class="key-value">
                            <span class="key"><?php echo ucfirst($key); ?></span>
                            <span class="val"><?php echo $value; ?></span>
                        </div>
                    <?php } ?>
                </div>

            </div>

            <div class="mt-15">
                <div style="color:#a8b5ff; font-weight:600; margin-bottom:10px;">Multi-dimensional Array (Students Data)</div>
                <div class="table-wrapper">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Grade</th>
                        </tr>
                        <?php foreach ($students_data as $s) { ?>
                        <tr>
                            <td><?php echo $s['id']; ?></td>
                            <td><?php echo $s['name']; ?></td>
                            <td><span class="tag tag-success"><?php echo $s['grade']; ?></span></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <?php
    // ============================================================
    // 6. FUNCTIONS
    // ============================================================
    ?>
    <div class="card fade-in delay-6">
        <div class="card-title">
            <span class="number">6</span> Functions
        </div>
        <div class="card-content">

            <?php
            function greet() {
                return "Hello! Welcome to PHP.";
            }

            function greetUser($name) {
                return "Hello, <strong>$name</strong>! Welcome to the internship.";
            }

            function add($a, $b) {
                return $a + $b;
            }

            function power($base, $exponent = 2) {
                return pow($base, $exponent);
            }

            function calculateAverage($numbers) {
                return array_sum($numbers) / count($numbers);
            }

            $marks = [80, 75, 90, 85, 70];
            ?>

            <div class="function-grid">

                <div class="value-box">
                    <div class="label">Simple Function</div>
                    <div class="value" style="font-size:0.9rem;"><?php echo greet(); ?></div>
                </div>

                <div class="value-box">
                    <div class="label">With Parameter</div>
                    <div class="value" style="font-size:0.9rem;"><?php echo greetUser("Bisma Khan"); ?></div>
                </div>

                <div class="value-box">
                    <div class="label">Addition</div>
                    <div class="value">15 + 25 = <?php echo add(15, 25); ?></div>
                </div>

                <div class="value-box">
                    <div class="label">Power (Default)</div>
                    <div class="value">5&sup2; = <?php echo power(5); ?></div>
                </div>

                <div class="value-box">
                    <div class="label">Power (Custom)</div>
                    <div class="value">5&sup3; = <?php echo power(5, 3); ?></div>
                </div>

                <div class="value-box">
                    <div class="label">Average</div>
                    <div class="value" style="font-size:1rem;">
                        <?php echo implode(', ', $marks); ?> <br>
                        <span style="color:#38ef7d;">Avg: <?php echo calculateAverage($marks); ?></span>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <?php
    // ============================================================
    // 7. STRING FUNCTIONS
    // ============================================================
    ?>
    <div class="card fade-in delay-7">
        <div class="card-title">
            <span class="number">7</span> String Functions
        </div>
        <div class="card-content">

            <?php
            $text = "Hello, welcome to PHP Laravel Internship at POF!";
            ?>

            <div style="background:rgba(255,255,255,0.05); padding:15px 20px; border-radius:12px; margin-bottom:15px; text-align:center;">
                <span style="color:rgba(255,255,255,0.5);">Original Text</span>
                <div style="color:#fff; font-size:1.2rem; font-weight:600;"><?php echo $text; ?></div>
            </div>

            <div class="string-grid">

                <div class="string-box">
                    <div class="s-label">Length</div>
                    <div class="s-value" style="font-size:1rem;"><?php echo strlen($text); ?> chars</div>
                </div>

                <div class="string-box">
                    <div class="s-label">Uppercase</div>
                    <div class="s-value" style="font-size:0.8rem;"><?php echo strtoupper(substr($text, 0, 25)) . '...'; ?></div>
                </div>

                <div class="string-box">
                    <div class="s-label">Lowercase</div>
                    <div class="s-value" style="font-size:0.8rem;"><?php echo strtolower(substr($text, 0, 25)) . '...'; ?></div>
                </div>

                <div class="string-box">
                    <div class="s-label">Word Count</div>
                    <div class="s-value"><?php echo str_word_count($text); ?> words</div>
                </div>

                <div class="string-box">
                    <div class="s-label">Replace</div>
                    <div class="s-value" style="font-size:0.8rem;">"PHP" &rarr; "Laravel"</div>
                </div>

                <!-- PHP 7.4 Compatible - Using strpos() instead of str_contains() -->
                <div class="string-box">
                    <div class="s-label">Contains "POF"</div>
                    <div class="s-value" style="font-size:1rem;">
                        <?php echo strpos($text, "POF") !== false ? 'Yes' : 'No'; ?>
                    </div>
                </div>

            </div>

            <div class="result result-success mt-15">
                <strong>Replaced:</strong> <?php echo str_replace("PHP", "Laravel", $text); ?>
            </div>

        </div>
    </div>

    <!-- ========== FOOTER ========== -->
    <div class="text-center" style="padding:30px 0 10px; border-top:1px solid rgba(255,255,255,0.05); margin-top:20px;">
        <span class="text-muted" style="font-size:0.85rem;">Day 2 - PHP Basics Exercises &bull; PHP &amp; Laravel Internship Program</span>
    </div>

</div>

</body>
</html>