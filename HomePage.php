<?php
// Include the file with the Controller class
require_once 'core/controller.Class.php';

// // Start the session (make sure this is at the top of your PHP file)
session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     // Redirect to the login page if not logged in
//     header('Location: login.php');
//     exit();
// }

// // Your existing HTML and PHP code for the homepage goes here

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Add your styles or link to a CSS file here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        section {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #3498db;
        }

        p {
            line-height: 1.6;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }


        
    </style>
</head>

<body>
    
    <header>
        <h1>Welcome to the Teacher Evaluation System</h1>
    </header>
    <section>
        <p><a href="index.php">Go to Evaluation</a></p>
    </section>

    <footer>
        <p>&copy; 2024 Teacher Evaluation System</p>
    </footer>
    <!-- Add your scripts or link to a JS file here -->
</body>

</html>