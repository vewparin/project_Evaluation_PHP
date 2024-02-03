<?php
require_once('core/controller.Class.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming your form fields are named 'f_name', 'l_name', 'email', 'password', and 'confirm_password'
    $data = [
        "givenName"         => $_POST["f_name"],
        "familyName"        => $_POST["l_name"],
        "avatar"            => "", // You may need to handle avatar upload separately
        "email"             => $_POST["email"],
        "password"          => $_POST["password"],
        "confirm_password"  => $_POST["confirm_password"],
    ];

    // Perform validation on form data if needed

    // Assuming you have a class instance to call insertData method
    $Controller = new Controller;
    $Controller->insertData($data);
}
?>
