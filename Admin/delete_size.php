<?php
include_once __DIR__. '../controller/productController.php';

$id=$_GET['sid'];
$pid=$_GET['pid'];
$con=new productController();
$result=$con->deleteSizeColor($id);
if ($result) {
    echo '<script> location.href="product_detail.php?pid=' . $pid . '"; </script>';
}


?>