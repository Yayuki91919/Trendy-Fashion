<?php 
include_once __DIR__. '../controller/adminloginController.php';
$admin_controller = new adminloginController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    $admin = new Admin();
    $resetSuccess = $admin_controller->resetAdminPassword($token, $password);

    if ($resetSuccess) {
        echo "Your password has been reset successfully.";
    } else {
        echo "Invalid or expired token.";
    }
}

?>