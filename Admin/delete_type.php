<?php
include_once __DIR__. '../controller/typeController.php';

$id=$_POST['id'];
$con=new TypeController();
$result=$con->deleteType($id);

?>