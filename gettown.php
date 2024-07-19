<?php
include_once __DIR__ . '/Admin/controller/locationController.php';
$location_controller = new LocationController();

if (isset($_GET['q'])) {
    $city = $_GET['q'];
    $locations = $location_controller->getLocationListByCity($city);
    echo '<option value="">' . "Select Township" . '</option>';
    foreach ($locations as $row) {
        echo '<option value="' . $row['location_id'] . '">' . $row['township'] . '</option>';
    }
}
?>
