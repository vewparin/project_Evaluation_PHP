<?php
require_once('core/controller.Class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming your form fields are named 'teacher_name', 'subject', 'rating', 'comments', and 'email'
    $data = [
        "teacher_name" => $_POST["teacher_name"],
        "subject"      => $_POST["subject"],
        "rating"       => $_POST["rating"],
        "comments"     => $_POST["comments"],
        "email"        => $_POST["email"],
    ];

    // Perform validation on form data if needed

    $db = new Connect;
    $sql = "INSERT INTO teacher_evaluation (teacher_name, subject, rating, comments, user_email) VALUES (:teacher_name, :subject, :rating, :comments, :email)";
    $insertEvaluation = $db->prepare($sql);
    $insertEvaluation->execute([
        ':teacher_name' => $data["teacher_name"],
        ':subject'      => $data["subject"],
        ':rating'       => $data["rating"],
        ':comments'     => $data["comments"],
        ':email'        => $data["email"],
    ]);

    // Redirect to a thank you page or wherever appropriate
    echo '<script>alert("บันทึกข้อมูลสำเร็จ");</script>';
    echo '<script>window.location.href = "HomePage.php";</script>';
    exit();
    exit();
}
