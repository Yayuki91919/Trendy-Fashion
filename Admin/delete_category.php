<?php
include_once __DIR__. '../controller/categoryController.php';

$id=$_POST['id'];
$payment_con=new CategoryController();
$result=$payment_con->deleteCategory($id);

?>