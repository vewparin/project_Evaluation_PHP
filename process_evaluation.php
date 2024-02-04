<?php
require_once 'core/controller.Class.php'; // Include the Connect class

try {
    $db = new Connect;
    var_dump($_COOKIE);
    // Check if user is logged in
    if (isset($_COOKIE['id']) && isset($_COOKIE['sess'])) {
        $Controller = new Controller;

        // Check user status
        if ($Controller->checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])) {
            // Fetch user ID and email
            $userID = $_COOKIE['id'];
            $userEmail = $Controller->printEmail($userID);

            // Receive data from the form
            $teacher_name = $_POST['teacher_name'];
            $subject = $_POST['subject'];
            $rating = $_POST['rating'];
            $comments = $_POST['comments'];

            // Prepare the SQL statement in a prepared statement format
            $sql = "INSERT INTO teacher_evaluation (teacher_name, subject, rating, comments, user_email) VALUES (?, ?, ?, ?, ?)";

            // Prepare and create the statement
            $stmt = $db->prepare($sql);

            // Check if the prepared statement is created successfully
            if ($stmt) {
                // Bind the data values
                $stmt->bindParam(1, $teacher_name);
                $stmt->bindParam(2, $subject);
                $stmt->bindParam(3, $rating);
                $stmt->bindParam(4, $comments);
                $stmt->bindParam(5, $userEmail);

                // Execute the statement to add data
                if ($stmt->execute()) {
                    // Close the statement
                    $stmt = null;

                    // Alert the user about the successful data entry
                    echo '<script>alert("บันทึกข้อมูลสำเร็จ");</script>';

                    // Redirect to the homepage after showing the alert
                    echo '<script>window.location.href = "HomePage.php";</script>';
                    exit();
                } else {
                    echo "Error: " . $stmt->errorInfo()[2];
                }

                // Close the statement
                $stmt = null;
            } else {
                echo "Error: Unable to prepare statement";
            }
        }
    } else {
        // Handle the case where the user is not logged in
        echo "User not logged in.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    $db = null;
}
?>
