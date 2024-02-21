<?php
require_once('../../../config/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["province_id"])) {
$provinceId = $_POST["province_id"];

$query = "SELECT * FROM districts WHERE province_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $provinceId);
$stmt->execute();
$result = $stmt->get_result();

$districts = array();
while ($row = $result->fetch_assoc()) {
    $districts[] = array(
        'district_id' => $row['district_id'],
        'district_name' => $row['district_name']
    );
}

echo json_encode($districts);
} else {
    echo json_encode(array('error' => 'Invalid request'));
}




