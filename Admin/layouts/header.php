<?php
//session_start();
// if(isset($_SESSION['username'])){
//     echo '<script>window.location.href = "index.php";</script>';
//    }
include_once __DIR__ . '/../controller/profileController.php';
include_once __DIR__ . '/../controller/productController.php';
$product_controller = new ProductController();
$profile_controller = new ProfileController();
$profiles = $profile_controller->getProfile();

if (!empty($profiles)) {
    foreach ($profiles as $profile) {
        $image = $profile['image'];
        $password = $profile['password'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="trendy-fashion" />

    <title>Trendy Fashion</title>
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> -->


    <link rel="apple-touch-icon" sizes="180x180" href="./icons/trendy-icon/apple-touch-icon.png">
    </link>
    <link rel="icon" type="image/png" sizes="32x32" href="./icons/trendy-icon/favicon-32x32.png">
    </link>
    <link rel="icon" type="image/png" sizes="16x16" href="/../icons/trendy-icon/favicon-16x16.png">
    </link>

    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./plugins/sweetalert/css/sweetalert.css" rel="stylesheet">
    <link href="./plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="./plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="./plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="./plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="./plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./plugins/summernote/dist/summernote.css" rel="stylesheet">


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div> -->
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header gradient-2">
            <div class="brand-logo gradient-2">
                <a href="index.php">
                    <!-- <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span> -->
                    <span class="brand-title">
                        <!-- <img src="images/logo-text.png" alt="h"> -->
                        <h3 class="text-white">Trendy Fashion</h3>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <?php
                                $processing = $product_controller->getProcessingDelivery();
                                $num_processing = count($processing);
                                ?>
                                <span class="badge badge-pill gradient-1"><?php echo $num_processing ?></span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">

                                    <span class=""><?php echo $num_processing ?> New Messages</span>

                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <?php foreach ($processing as $p) { ?>
                                            <li class="notification-unread">
                                                <a href="invoice_detail.php?invoice_id=<?php echo $p['invoice_id']; ?>">
                                                    <!-- <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg" alt=""> -->
                                                    <span class="float-left mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                    <div class="notification-content">
                                                        <div class="notification-heading"><?php echo "Invoice No : " . $p['invoice_no']; ?></div>
                                                        <div class="notification-timestamp"><?php echo "Invoice Date : " .$p['invoice_date'] ?></div>
                                                        <div class="notification-text"><?php echo "Total : " .$p['total'] . " Ks" ?></div>
                                                        <!-- <span class="badge badge-pill gradient-1"></span> -->
                                                    </div>
                                                </a>
                                            </li>
                                        <?php
                                        } ?>
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <?php
                                $low_stock = $product_controller->getLowProduct();
                                $num_low_stock = count($low_stock);

                                ?>
                                <span class="badge badge-pill gradient-2"><?php echo $num_low_stock; ?></span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">

                                    <span class=""><?php echo $num_low_stock; ?> New Notifications</span>

                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <?php foreach ($low_stock as $l) { ?>
                                            <li>
                                                <a href="product_detail.php?<?php echo $l['product_id']; ?>">
                                                    <img class="float-left mr-3 avatar-img" src="images/product/<?php echo $l['random_image'] ?>" alt="">

                                                    <div class="notification-content">
                                                        <h6 class="notification-heading"><?php echo $l['product_name']; ?></h6>
                                                        <span class="notification-text"><?php echo $l['size'] . " & " . $l['color']; ?></span>

                                                        <span class="badge badge-pill gradient-2"><?php echo $l['qty'] ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php
                                        } ?>


                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/profile/<?php echo $image; ?>" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="profile.php"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <!-- <li>
                                            <a href="javascript:void()">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li> -->

                                        <hr class="my-2">
                                        <li>
                                            <a href="#"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li><a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="dashboard.php" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Home 1</a></li>
                             <li><a href="./index-2.html">Home 2</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-label">About Product</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Product</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="category.php">Category</a></li>
                            <li><a href="sub_category.php">Sub-Category</a></li>
                            <li><a href="product_type.php">Product Type</a></li>
                            <li><a href="product_size.php">Product Size</a></li>
                            <li><a href="product_color.php">Product Color</a></li>
                            <li><a href="product.php">Product List</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Order</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Cutomer Details</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="customer.php">Customer & Order</a></li>
                            <li><a href="invoice.php">Order Details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Delivery Setting</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="delivery_setting.php">Delivary Fees</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">For Users</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i> <span class="nav-text">User Interface</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./banner.php">Banners</a></li>
                            <li><a href="./collaboration.php">Collabration</a></li>
                            <li><a href="./shopinfo.php">Shop Info</a></li>
                            <li><a href="./social.php">Shop Social</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-label">UI Components</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">UI Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-cards.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./uc-nestedable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="widgets.html" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Widget</span>
                        </a>
                    </li>
                    <li class="nav-label">Forms</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Forms</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./form-basic.html">Basic Form</a></li>
                            <li><a href="./form-validation.html">Form Validation</a></li>
                            <li><a href="./form-step.html">Step Form</a></li>
                            <li><a href="./form-editor.html">Editor</a></li>
                            <li><a href="./form-picker.html">Picker</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Table</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i><span class="nav-text">Table</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./table-basic.html" aria-expanded="false">Basic Table</a></li>
                            <li><a href="./table-datatable.html" aria-expanded="false">Data Table</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Pages</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./page-login.html">Login</a></li>
                            <li><a href="./page-register.html">Register</a></li>
                            <li><a href="./page-lock.html">Lock Screen</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-404.html">Error 404</a></li>
                                    <li><a href="./page-error-403.html">Error 403</a></li>
                                    <li><a href="./page-error-400.html">Error 400</a></li>
                                    <li><a href="./page-error-500.html">Error 500</a></li>
                                    <li><a href="./page-error-503.html">Error 503</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->