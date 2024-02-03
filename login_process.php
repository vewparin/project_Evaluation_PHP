<?php
require_once('core/controller.Class.php');
require_once('controller.php');

// Include your Connect class definition and checkUserStatus function definition here

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform authentication (you might want to use password_hash and password_verify for secure password handling)
    // Assuming you have a function like authenticateUser, update it accordingly
    
    $userId = $Controller->authenticateUser($email, $password);

    if ($userId !== false) {
        // Authentication successful
        $session = $Controller->generateSession(); // You need to implement a function to generate a session
        $db = new Connect;
        
        // Update the user's session in the database
        $updateSession = $db->prepare("UPDATE users SET session=:session WHERE id=:id");
        $updateSession->execute([
            ':session' => $session,
            ':id' => $userId,
        ]);

        // Redirect the user to a secured page or perform other actions
        header("Location: HomePage.php");
        exit();
    } else {
        // Authentication failed
        echo "Invalid credentials. Please try again.";
    }
}
?>
