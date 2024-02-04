<?php
require_once('core/controller.Class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming your form fields are named 'email' and 'password'
    $data = [
        "email"    => $_POST["email"],
        "password" => $_POST["password"],
    ];

    // Perform validation on form data if needed

    $Controller = new Controller;
    $db = new Connect;
    $checkUser = $db->prepare("SELECT * FROM users WHERE email=:email");
    $checkUser->execute(['email' => $data["email"]]);
    $info = $checkUser->fetch(PDO::FETCH_ASSOC);

    if ($info) {
        // Check if the provided password matches the stored hashed password
        if (password_verify($data["password"], $info["password"])) {
            $Controller->loginWithSession($info['id'], $info["session"]);
        } else {
            // Password does not match, redirect to login page or handle authentication failure
           $Controller->EvaluationForm($info['id']);
            exit();
        }
    } else {
        // User not found, redirect to login page or handle authentication failure
        header('Location: index.php');
        exit();
    }
}
?>
