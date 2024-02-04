<?php
// Load the database configuration file
include_once 'core/controller.Class.php';
$db = new Connect;

// Check if ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete member data from the database
    $db->query("DELETE FROM members WHERE id = $id");

    // Redirect back to the listing page with success message
    header("Location: ImportCSVPage.php?status=delete_succ");
} else {
    // Redirect back to the listing page with error message
    header("Location: ImportCSVPage.php?status=delete_err");
}
?>
