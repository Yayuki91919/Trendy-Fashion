<?php
// get_colors.php

include_once __DIR__ . '/Admin/controller/productController.php';

$product_controller = new productController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['size'])) {
    $size = $_POST['size'];
    $product_id = $_POST['product_id'];
    
    // Fetch colors for the selected size
     $colors = $product_controller->getColorsBySize($size,$product_id);
    // $colors = [
    //     ['color_id' => 1, 'color' => 'Red'],
    //     ['color_id' => 2, 'color' => 'Blue'],
    //     ['color_id' => 3, 'color' => 'Green']
    // ];
    
    // Prepare JSON response
    header('Content-Type: application/json');
    echo json_encode($colors);
    exit;
}
?>