<?php
// Assuming this file is located in the root directory
include_once __DIR__ . '/controller/subController.php';

$sub_controller = new SubCategoryController();

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $subcategories = $sub_controller->getselectCategory($category_id);

    header('Content-Type: application/json');
    echo json_encode($subcategories);
    exit;
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Category ID not provided";
}
?>
