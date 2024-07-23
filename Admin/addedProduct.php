<?php 
include_once __DIR__ . '../controller/productController.php';

$product_controller = new productController();

if(isset($_GET['pid']))
{
    $pid = $_GET['pid'];
    echo '<script> location.href="product_detail.php?pid=' . $pid . '"</script>';

}
?>