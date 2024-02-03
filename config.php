<?php
require_once('google-api/vendor/autoload.php');
$gClient = new Google_Client();
$gClient->setClientId("463399977729-l6b7d4a6ho54i3dupoq7vqe7t090c9cj.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Vicode Media Login");
$gClient->setRedirectUri("http://localhost/logingoogle/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

$login_url = $gClient->createAuthUrl();

?>