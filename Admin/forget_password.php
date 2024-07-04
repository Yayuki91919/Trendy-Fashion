<?php
// Include Composer's autoload file
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
try {
    $dotenv->load();
} catch (Exception $e) {
    die('Could not load environment variables: ' . $e->getMessage());
}

include_once __DIR__ . '/../controller/adminloginController.php';

$admin_controller = new adminloginController();

// Initialize variables
$email = $login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    if (empty($_POST["email"])) {
        $login_error = "Email Address is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $db_email = $admin_controller->getAdminEmail($email);

        if ($db_email) {
            // Generate a unique token
            $token = bin2hex(random_bytes(50));
            
            // Store token in the database
            if ($admin_controller->updateAdminResetToken($email, $token)) {
                // Send the reset link to the user's email
                $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $_ENV['SMTP_USERNAME'];
                    $mail->Password   = $_ENV['SMTP_PASSWORD'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    // Recipients
                    $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
                    $mail->addAddress($email);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset';
                    $mail->Body    = "Click on this link to reset your password: <a href='$resetLink'>$resetLink</a>";

                    $mail->send();
                    echo "A password reset link has been sent to your email.";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Failed to update reset token.";
            }
        } else {
            echo "Email does not exist.";
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
    <title>Forget Password</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="./icons/trendy-icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./icons/trendy-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./icons/trendy-icon/favicon-16x16.png">
    <style>
    .error {color: #FF0000;}
    </style>
</head>
<body class="h-100">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Forget Password</h4></a>
                                <form class="mt-5 mb-5 login-input" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <center><label class="error"><?php echo $login_error; ?></label></center>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                                    </div>
                                    <button class="btn gradient-2 login-form__btn submit w-100" name="submit">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>
