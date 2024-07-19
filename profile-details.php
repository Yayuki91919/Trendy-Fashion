<?php 
include_once 'layouts/header.php';
$cus_id=6;
include_once __DIR__. '/Admin/controller/customerController.php';
$customer_controller=new CustomerController();
$customer=$customer_controller->getCustomer($cus_id);
$name=$customer['username'];
$email=$customer['email'];
$password=$customer['password'];
$phone=$customer['phone'];
$cus_id=$customer['customer_id'];
if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $password=$_POST['password'];
  $cus_id=$_POST['cust_id'];
  $result=$customer_controller->editCustomer($cus_id,$name,$email,$phone,$password);
  if($result)
  {
      $message=2;
      echo '<script>location.href="profile-details.php?status='.$message.'"</script>';
  }
}

?>

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Dashboard</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">my account</li>
                    </ol>
                    <?php if(isset($_GET['status'])&& $_GET['status']=="2"){ ?>
                    <div class="alert alert-info alert-common alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <i class="tf-ion-android-checkbox-outline"></i><span>You have successfully updated your profile data!</span> 
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="user-dashboard page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline dashboard-menu text-center">
                    <li><a href="order.php">Orders</a></li>
                    <li><a class="active" href="profile-details.php">Profile Details</a></li>
                </ul>
                <div class="dashboard-wrapper dashboard-user-profile">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <?php if(isset($_GET['edit_id']) || isset($_POST['cust_id'])){ ?>
                                    <div class="block billing-details">
                                        <h4 class="widget-title">Profile Update</h4>
                                        <form class="checkout-form" action="profile-details.php" method="post"
                                            onsubmit="return validateForm()">
                                            <div class="form-group">
                                                <input type="hidden" name="cust_id" value="<?php echo $cus_id ?>">
                                                <label for="full_name">Username</label>
                                                <input type="text" class="form-control" name="name" id="full_name"
                                                    value="<?php echo $name ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_address">Email</label>
                                                <input type="email" class="form-control" name="email" id="user_email"
                                                    value="<?php echo $email ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_address">Password</label>
                                                <input type="password" minlength="8" class="form-control"
                                                    name="password" id="user_password" value="<?php echo $password; ?>"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="user_phone"
                                                    value="<?php echo $phone ?>" required>
                                            </div>
                                            <input type="submit" name="submit" value="Edit" class="btn btn-main mt-20">
                                        </form>
                                    </div>
                                    <?php }else{  ?>
                                    <ul class="user-profile-list">
                                        <li><span>Full Name:</span><?php echo $customer['username'] ?></li>
                                        <li><span>Email:</span><?php echo $customer['email'] ?></li>
                                        <li><span>Phone:</span><?php echo $customer['phone'] ?></li>
                                        <li class="text-center"><a
                                                href="profile-details.php?edit_id=<?php echo $cus_id ?>"
                                                class="btn btn-small"><i class="tf-pencil2" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function validateForm() {
    // Get form elements
    var email = document.getElementById("user_email").value;
    var password = document.getElementById("user_password").value;
    var phone = document.getElementById("user_phone").value;

    // Regular expressions for validation
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var phonePattern = /^(\+?95|0)(9|\d{1})\d{7,9}$/;

    // Validate email if not empty
    if (email !== "" && !emailPattern.test(email)) {
        alert("Invalid email format");
        return false;
    }

    // Validate password length if not empty
    if (password !== "" && password.length < 8) {
        alert("Password must be at least 8 characters long");
        return false;
    }

    // Validate phone number if not empty
    if (phone !== "" && !phonePattern.test(phone)) {
        alert("Invalid Myanmar phone number format");
        return false;
    }

    // If all validations pass
    return true;
}
<?php
include_once 'layouts/footer.php';
?>