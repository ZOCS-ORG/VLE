<?php
require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');
$add_side_bar = true;

error_reporting(E_ALL);
$school_id = $_GET['school_id'];
// echo $school_id;
// echo $school_id;
if (isset($_POST['update'])) {
    // Retrieve form data and sanitize
    $school_id = $_GET['school_id'];
    $emis_number = mysqli_real_escape_string($db, $_POST['emis_number']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $zone = mysqli_real_escape_string($db, $_POST['zone']);
    $province = mysqli_real_escape_string($db, $_POST['province']);
    $district = mysqli_real_escape_string($db, $_POST['district']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $gps_lat = mysqli_real_escape_string($db, $_POST['gps_lat']);
    $gps_long = mysqli_real_escape_string($db, $_POST['gps_long']);

    // Construct the SQL query for updating the school
    $sql = "UPDATE schools SET `name` = '$name', `address` = '$address', `zone` = '$zone', `sch_type` = '$type',
                            `gps_lat` = '$gps_lat', `gps_long` = '$gps_long', `emis_number` = '$emis_number',
                            `province` = '$province', `district` = '$district'
                            WHERE `school_id` = '$school_id' ";

    // Execute the update query
    $success = mysqli_query($db, $sql);
    echo $success;
    // Check if the update was successful
    if ($success) {
       
        echo "<script>window.location.href = 'update_school.php?school_id=$school_id&success=true';</script>";
      
    } else {

        die('Could not update data: ' . mysqli_error($db));
    }
}

?>