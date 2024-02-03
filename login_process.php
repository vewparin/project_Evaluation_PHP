<?php
require_once('core/controller.Class.php');
$Controller = new Controller;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // กำหนดให้ฟิลด์ของฟอร์มชื่อ 'email'
    $email = $_POST["email"];

    // ตรวจสอบความถูกต้องของอีเมล (คุณอาจต้องการเพิ่มการตรวจสอบเพิ่มเติม)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // สมมติว่าคุณมีอินสแตนซ์คลาสเพื่อเรียกใช้เมธอดเพื่อตรวจสอบข้อมูลผู้ใช้
        $isUserValid = $Controller->checkUserCredentials($email);

        if ($isUserValid) {
            // ผู้ใช้ถูกต้อง, เปลี่ยนเส้นทางไปที่หน้าหลักหรือหน้าอื่น ๆ
            header('Location: HomePage.php');
            exit();
        } else {
            // ไม่พบผู้ใช้หรือข้อมูลเข้าสู่ระบบไม่ถูกต้อง
            echo "ข้อมูลเข้าสู่ระบบไม่ถูกต้อง โปรดลองอีกครั้ง";
        }
    } else {
        echo "รูปแบบอีเมลไม่ถูกต้อง โปรดป้อนที่อยู่อีเมลที่ถูกต้อง";
    }
}
?>
