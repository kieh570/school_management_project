<?php 
require_once "db_connect/connection.php";

    if(
    !empty($_POST["first_name"]) &&
    !empty($_POST["first_name"]) &&
    !empty($_POST["dob"]) &&
    !empty($_POST["pob"]) &&
    !empty($_POST["address"]) &&
    !empty($_POST["nationality"]) &&
    !empty($_POST["contact"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["class"]) &&
    !empty($_POST["signup_date"]) &&
    !empty($_POST["password"]) &&
    !empty($_POST["confirm_password"]) &&
    !empty($_POST["gender"]) 
    ){
        $first_name = htmlspecialchars($_POST["first_name"]);
        $middle_name = htmlspecialchars($_POST["middle_name"] ?? '');
        $last_name = htmlspecialchars($_POST["last_name"]);
        $dob = htmlspecialchars($_POST["dob"]);
        $pob = htmlspecialchars($_POST["pob"]);
        $address = htmlspecialchars($_POST["address"]);
        $nationality = htmlspecialchars($_POST["nationality"]);
        $contact = htmlspecialchars($_POST["contact"]);
        $email = htmlspecialchars($_POST["email"]);
        $class = htmlspecialchars($_POST["class"]);
        $signup_date = htmlspecialchars($_POST["signup_date"]);
        $password = htmlspecialchars($_POST["password"]);
        $confirm_password = htmlspecialchars($_POST["confirm_password"]);
        $gender = htmlspecialchars($_POST["gender"]);

        //OTHER VALIDATIONS
        if($confirm_password !== $password){
            echo "Password not match";
            exit;
        }

        if(strlen($password) < 6){
            echo "Password too short";
            exit;
        }

        $specialchar = "/*@#$%^.,^><?";

        if(!preg_match($password, $specialchar)){
            echo "Password must contain special characters";
            exit;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Invalid email format";
            exit;
        }

        $contact = preg_replace('/\s=/', '', $__POST['contact']);

        if(preg_match('/^(0(77|88|55|60)\d{7}|\+231(77|88|55|60)\d{7})$/', $contact)){
            echo "Incorrect contact format";
            exit;
        }

        /*function generateStudentID($conn){
            do {
                $id = mt_rand(100000, 999);
                $stmt = $conn->prepare("SELECT")
            }
        }*/





    } else {
        echo "Please fill in all inputs";
    }
?>