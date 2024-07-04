<?php
include_once __DIR__. '/../controller/adminloginController.php';
$admin_controller = new adminloginController();

// Initialize variables
$token = $password = $confirm_password = "";
$password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $token = $_POST['token'];
    $password = test_input($_POST["password"]);
    $confirm_password = test_input($_POST["confirm_password"]);

    // Validate password
    if (empty($password)) {
        $password_err = "Please enter a password.";
    } elseif (strlen($password) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } elseif ($password != $confirm_password) {
        $password_err = "Password did not match.";
    }

    // Proceed if no errors
    if (empty($password_err)) {
        // Reset password using the token
        $resetSuccess = $admin_controller->resetAdminPassword($token, $password);

        if ($resetSuccess) {
            echo "Your password has been reset successfully.";
            // Redirect or display a success message
        } else {
            echo "Failed to reset password. Please try again.";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset Password</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    .error { color: #FF0000; }
    body { background-color: #f3f4f6; }
    .login-form-bg { background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; height: 100vh; }
    .login-form { box-shadow: 0 0 20px 0 rgba(69, 90, 100, 0.08); }
    .login-input { padding: 20px; }
    .login-input .form-group { margin-bottom: 20px; }
    .login-input .form-control { background-color: #f7f7f7; }
    .login-input .btn { padding: 10px 20px; }
    .login-input .btn.submit { background-color: #5c6bc0; border: none; }
    .login-input .btn.submit:hover { background-color: #3949ab; }
    .login-form__footer { text-align: center; }
</style>

<body class="h-100">

    <div class="login-form-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form">
                            <div class="card-body pt-5">
                                <h4 class="text-center mb-4">Reset Password</h4>

                                <form class="login-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="New Password" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                                        <span class="error"><?php echo $password_err; ?></span>
                                    </div>

                                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">

                                    <button type="submit" class="btn gradient-2 login-form__btn submit w-100">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>

</html>