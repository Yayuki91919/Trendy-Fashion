<?php
include_once __DIR__ . '/Admin/controller/feeController.php';
$fee_controller = new FeeController();

if (isset($_GET['f'])) {
    $id = $_GET['f'];
    $fee = $fee_controller->getFeeInfoByLocationId($id);

    if ($fee === false) {
        // Handle the error, e.g., by outputting an error message
        echo "Unknown";
    } else {
        echo $fee['fee']." MMK";
    }
} else {
    echo "No location ID provided.";
}
?>
