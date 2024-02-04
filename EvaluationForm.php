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
    <title>แบบฟอร์มการประเมิน</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-danger {
            background-color: #d9534f;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .top-right {
            position: absolute;
            top: 50px;
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
    </style>
</head>

<body>

    <?php
    if (isset($_COOKIE['id']) && isset($_COOKIE['sess'])) {
        $Controller = new Controller;

        if ($Controller->checkUserStatus($_COOKIE['id'], $_COOKIE['sess']) ) {
            
            // Fetch user ID from cookies
            $userID = $_COOKIE['id'];
            // Display logout button
            echo '<div class="btn-container top-right">';
            echo '<a href="logout.php" class="btn-logout">ออกจากระบบ</a>';
            echo '</div>';

            echo '<div class="user-info">';
            echo '<div class="user-info"><strong>' . $Controller->printName($userID) . '</strong></div>';
            echo '<div class="user-info"><strong>' . $Controller->printEmail($userID) . '</strong></div>';

            echo '</div>';
    ?>
            <div class="form-container">
                <h2>แบบประเมินการสอน</h2>
                <form action="process_evaluation.php" method="post">
                    <div class="form-group">
                        <label for="teacher_name">ชื่อครูผู้สอน:</label>
                        <input type="text" name="teacher_name" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">วิชาที่สอน:</label>
                        <input type="text" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="rating">คะแนนการสอน (1-10):</label>
                        <input type="number" name="rating" min="1" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="comments">ความคิดเห็น:</label>
                        <textarea name="comments" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">อีเมล:</label>
                        <input type="email" name="email" value="<?php echo $Controller->printEmail($userID); ?>" required>
                    </div>
                    <button type="submit">ส่งแบบประเมิน</button>
                </form>
            </div>
    <?php
        }
        
    } else {

        header('Location: index.php');
        exit();
    }
    ?>

</body>

</html>