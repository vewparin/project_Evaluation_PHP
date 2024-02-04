<?php
session_start();
require_once('config.php');
require_once('core/controller.Class.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Google</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    body {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .btn-primary {
        color: #fff;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
    }

    .btn-danger:hover {
        background-color: #bd2130;
    }

    .top-right {
        position: absolute;
        top: 115px;
        right: 30px;
    }

    .btn-logout {
        background-color: #d9534f;
        color: #fff;
        padding: 5px;
        text-decoration: none;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-logout:hover {
        background-color: #c9302c;
    }

    .user-info {
        position: relative;
        right: 20px;
        text-align: right;
        font: bold;
    }

    p a {
        color: #3498db;
        /* Set the link color */
        text-decoration: none;
        /* Remove underlines from links */
        font-weight: bold;
        /* Make the text bold */
        transition: color 0.3s ease-in-out;
        /* Add a smooth color transition effect */
    }

    p a:hover {
        color: #1f618d;
        /* Change the link color on hover */
    }
</style>

<body>
    
    <div class="container" style="margin-top: 100px;">

        <?php
        if (isset($_COOKIE['id']) && isset($_COOKIE['sess'])) {
            $Controller = new Controller;

            if ($Controller->checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])) {
                // Fetch user ID from cookies
                $userID = $_COOKIE['id'];
                // Display logout button
                echo '<div class="btn-container top-right">';
                echo '<a href="logout.php" class="btn-logout">ออกจากระบบ</a>';
                echo '</div>';

                echo '<div class="user-info">';
                echo '<div class="user-info"><strong>' . $Controller->printName($userID, $db) . '</strong></div>';
                echo '</div>';

                $Controller->printEvaluationForm(); // Replace with your actual logic to get the user's email

            }
        } else { ?>
            <img src="img/RMUTK-LOGO-01.jpg" alt="" style="display: block; margin: 0 auto; max-width: 150px;">
            <form action="login_process.php" method="POST">
                <button onclick="window.location ='<?php echo $login_url; ?>'" type="button" class="btn btn-danger">Login With Google</button>
                <p>Log in with Email&Password <a href="login.php">Login</a></p>
                <p>Not yet a member? <a href="register.php">Sign up</a></p>
            </form>

        <?php } ?>
    </div>
</body>

</html>