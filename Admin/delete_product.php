<?php
include_once __DIR__. '../controller/productController.php';


if(isset($_POST['delete_size']))
{
    $id=$_POST['delete_size'];
    $controller=new productController();
    $result = $controller->deleteSizeColor($id);
    // $result = $id;
}

?>