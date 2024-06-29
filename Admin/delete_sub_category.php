<?php
include_once __DIR__. '../controller/subController.php';

$id=$_POST['id'];
$con=new subCategoryController();
// $result=$con->deleteSubCategory($id);
$result=$id;

?>