<?php
require_once "db_connect/connection.php";
// SECURITY HEADERS
header("Content-Security-Policy: default-src 'self'");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
session_start();
// Generate CSRF Token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ONLY PROCESS WHEN FORM IS SUBMITTED
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF Validation
    /*if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }*/

    // INPUT SANITIZATION FUNCTION
    function clean($data) {
        return trim(htmlspecialchars(strip_tags($data ?? ''), ENT_QUOTES, 'UTF-8'));
    }

    $errors = [];

    // REQUIRED FIELDS
    $required = ['first_name', 'last_name', 'dob', 'pob', 'address', 'nationality', 'qualification', 
                 'contact', 'email', 'password', 'confirm_password', 'gender'];

    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required";
        }
    }

    // SANITIZE INPUTS
    $first_name     = clean($_POST['first_name'] ?? '');
    $middle_name    = clean($_POST['middle_name'] ?? '');
    $last_name      = clean($_POST['last_name'] ?? '');
    $dob            = clean($_POST['dob'] ?? '');
    $pob            = clean($_POST['pob'] ?? '');
    $address        = clean($_POST['address'] ?? '');
    $nationality    = clean($_POST['nationality'] ?? '');
    $qualification  = clean($_POST['qualification'] ?? '');
    $contact        = clean($_POST['contact'] ?? '');
    $email          = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $signup_date    = !empty($_POST['signup_date']) ? clean($_POST['signup_date']) : date('Y-m-d');
    $password       = $_POST['password'] ?? '';           // Do not clean raw password
    $confirm_password = $_POST['confirm_password'] ?? '';
    $gender         = clean($_POST['gender'] ?? '');

    // SERVER-SIDE VALIDATIONS
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Format";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords did not match";
    }

    if (!preg_match("/^[a-zA-Z\s'-]+$/", $first_name)) {
        $errors[] = "First name contains invalid characters";
    }

    if (!empty($dob) && !strtotime($dob)) {
        $errors[] = "Invalid Date of Birth";
    }

    // If there are errors, show them and stop
    if (!empty($errors)) {
        echo "<div style='color:red; padding:15px; background:#ffe6e6; border:1px solid red; margin:10px 0;'>";
        foreach ($errors as $err) {
            echo "• " . $err . "<br>";
        }
        echo "</div>";
        // Do NOT exit here if you want to show the form again
    } 
    else {
        // === PROCESS REGISTRATION ===

        // Generate Unique Student ID
        function generateUniqueTeacherID($conn) {
            $attempts = 0;
            do {
                $id = rand(10000000, 99999999); // 8 digits
                $stmt = $conn->prepare("SELECT id FROM teachers_table WHERE id = ?");
                $stmt->execute([$id]);
                $attempts++;
                if ($attempts > 50) {
                    die("Could not generate unique Teacher ID.");
                }
            } while ($stmt->rowCount() > 0);
            return $id;
        }

        $id = generateUniqueTeacherID($conn);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO teachers_table 
            (id, first_name, middle_name, last_name, dob, pob, address, nationality, qualification, 
             contact, email, signup_date, password, gender) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $success = $stmt->execute([
            $id, $first_name, $middle_name, $last_name, $dob, $pob, $address, 
            $nationality, $qualification, $contact, $email, $signup_date, $hashed_password, $gender
        ]);

 if ($success){  
    echo"<h1>Teacher Signup successful. $first_name ID is: $id</h1>";
    } else {
            echo "<div style='color:red; padding:15px; background:#ffe6e6;'>Signup Failed! Please try again.</div>";
        }
    }
}
?>
