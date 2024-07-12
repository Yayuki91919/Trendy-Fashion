<?php
include_once __DIR__ . '/Admin/controller/cartController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && is_numeric($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
    
    $cartController = new cartController;
    $removed = $cartController->removeCart($cart_id);

    if ($removed) {
        echo 'success'; // Return success message to Ajax request
    } else {
        echo 'error'; // Return error message to Ajax request
    }
} else {
    http_response_code(400); // Bad request status
    echo 'Invalid request'; // Return message for invalid request
}
?>
