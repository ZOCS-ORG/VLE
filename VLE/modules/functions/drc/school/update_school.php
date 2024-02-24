<?php
require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    // Display a success alert using JavaScript
    echo "<script>alert('Update Successful');</script>";
}
?>


<style>
    .table-width {
        padding-right: 75px;
        padding-left: 75px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 768px) {
        .table-width {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .table-width {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .table-width {
            width: 1170px;
        }
    }

    input {
        width: 90%;
    }

    select {
        width: 90%;
    }

    [type=radio] {
        width: 30%;
    }

    #map {
        height: 280px;
    }
</style>






<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8" style="border: 1px solid #73AD21; ">
            <div class="card shadow-s border-0 rounded-lg mt-1">
                <?php
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
                        // Use JavaScript to redirect the user
                        echo "<script>window.location.href = '{$_SERVER['PHP_SELF']}?school_id=$school_id';</script>";
                        echo $school_id;
                    } else {
                       
                        die('Could not update data: ' . mysqli_error($db));
                    }
                }

                // get school info from database
                $query = mysqli_query($db, "SELECT * FROM schools WHERE `school_id` = '$school_id' ") or die('Could not fetch data: ' . mysqli_error($db));
                $school_data  = mysqli_fetch_array($query);
                // assign values for the following values emis_number name address zone type gps_lat gps_long
                $emis_number = $school_data['emis_number'];
                $name = $school_data['name'];
                $address = $school_data['address'];
                $zone = $school_data['zone'];
                $type = $school_data['sch_type'];
                $gps_lat = $school_data['gps_lat'];
                $gps_long = $school_data['gps_long'];

                ?>
                <div class="card-header">
                    <h5 class="text-center my-2">Update School</h5>
                </div>
                <div class="card-body" style=" border-color: black ">
                    <form action="update_school_script.php?school_id=<?php echo $school_id ?>" method="post" enctype="multipart/form-data">
                        <!-- Add a hidden input field to store the school ID -->
                        <input type="hidden" name="school_id" value="<?php echo $school_data['school_id']; ?>">

                        <div class="form-group">
                            <label for="emis_number">Enter EMIS Number:</label>
                            <input id="emis_number" class="form-control" type="text" name="emis_number" placeholder="Enter EMIS Number" value="<?php echo $school_data['emis_number']; ?>" required>
                        </div>
                        <!-- Populate other form fields with existing data -->
                        <div class="form-group">
                            <label for="name">Enter School Name:</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="Enter School Name" value="<?php echo $school_data['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Enter School Address:</label>
                            <input id="address" class="form-control" type="text" name="address" placeholder="Enter School Address" value="<?php echo $school_data['address']; ?>" required>
                        </div>
                        <!-- Populate the select fields with existing data -->
                        <div class="form-group">
                            <label for="province">Select Province:</label>
                            <select id="province" name="province" class="form-control" onchange="loadDistricts()" disabled>
                                <option value="">Select Province</option>
                                <?php
                                $query = mysqli_query($db, "SELECT * FROM provinces");
                                if ($query) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $selected = ($row['province_id'] == $school_data['province']) ? 'selected' : '';
                                        echo "<option value='{$row['province_id']}' $selected>{$row['province_name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" style="display:none;">
                            <label for="district"><b>Select District:</b></label>
                            <select id="district" name="district" class="form-control" onchange="loadZones()" disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <div class="form-group" >
                            <label for="Zones"><b>Select Zone:</b></label>
                            <select id="Zones" name="zone" class="form-control">
                                <option value="">Select Zone</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Type of School:</label>
                            <select id="type" name="type" class="form-control">
                                <option value="University" <?php if ($school_data['sch_type'] == 'University') echo 'selected'; ?>>University</option>
                                <option value="College" <?php if ($school_data['sch_type'] == 'College') echo 'selected'; ?>>College</option>
                                <option value="Community School" <?php if ($school_data['sch_type'] == 'Community School') echo 'selected'; ?>>Community School</option>
                                <option value="Primary School" <?php if ($school_data['sch_type'] == 'Primary School') echo 'selected'; ?>>Primary School</option>
                            </select>
                        </div>
                        <!-- Similarly, populate other input fields with existing data -->

                        <div class="form-group">
                            <label for="gps_lat">Enter GPS Latitude Location:</label>
                            <input id="gps_lat" class="form-control" type="text" name="gps_lat" placeholder="Enter Latitude Location" value="<?php echo $school_data['gps_lat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="gps_long">Enter GPS Longitude Location:</label>
                            <input id="gps_long" class="form-control" type="text" name="gps_long" placeholder="Enter Longitude Location" value="<?php echo $school_data['gps_long']; ?>">
                        </div>
                        <div class="form-group">
                            <div id="map"></div>
                        </div>
                        <div class="form-group text-right">
                            <input class="btn btn-sm btn-success" type="submit" name="update" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$currentDistrictId = $school_data['district'];
$currentZoneId = $school_data['zone'];
?>

<script>
    function loadDistricts() {
        var provinceId = document.getElementById("province").value;
        var districtSelect = document.getElementById("district");

        districtSelect.innerHTML = "<option value=''>Select District</option>";

        if (provinceId !== "") {
            // Show the district select
            districtSelect.parentNode.style.display = "block";
            <?php
            $query = mysqli_query($db, "SELECT * FROM districts");
            if ($query) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "if ({$row['province_id']} == provinceId) {";
                    echo "var option = document.createElement('option');";
                    echo "option.value = '{$row['district_id']}';";
                    echo "option.textContent = '{$row['district_name']}';";
                    echo "districtSelect.appendChild(option);";
                    echo "}";
                }
            }
            ?>
        } else {
            // Hide the district select
            districtSelect.parentNode.style.display = "none";
        }

        // Select current district if available
        var currentDistrictId = "<?php echo $school_data['district']; ?>";
        if (currentDistrictId !== "") {
            document.querySelector('#district [value="' + currentDistrictId + '"]').selected = true;
        }
    }

    function loadZones() {
        var districtId = document.getElementById("district").value;
        var zoneSelect = document.getElementById("Zones");

        zoneSelect.innerHTML = "<option value=''>Select Zone</option>";

        if (districtId !== "") {
            // Show the zone select
            zoneSelect.parentNode.style.display = "block";
            <?php
            $query = mysqli_query($db, "SELECT * FROM zones");
            if ($query) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "if ({$row['district_id']} == districtId) {";
                    echo "var option = document.createElement('option');";
                    echo "option.value = '{$row['zone_id']}';";
                    echo "option.textContent = '{$row['zone']}';";
                    echo "zoneSelect.appendChild(option);";
                    echo "}";
                }
            }
            ?>
        } else {
            // Hide the zone select
            zoneSelect.parentNode.style.display = "none";
        }

        // Select current zone if available
        var currentZoneId = "<?php echo $school_data['zone']; ?>";
        if (currentZoneId !== "") {
            document.querySelector('#Zones [value="' + currentZoneId + '"]').selected = true;
        }
    }

    // Call the functions to populate the districts and zones initially
    window.onload = function() {
        loadDistricts();
        loadZones();
    };
</script>




<!-- Multi-Select suport -->
<link rel="stylesheet" href="../../../assets/select_box/vanillaSelectBox.css">
<script src="../../../assets/select_box/vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#zone", {
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        disableSelectAll: true,
        placeHolder: "Select",
    });
</script>

<script>
    var map = L.map('map').setView([-15.4089, 28.2871], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
        var clickedLat = e.latlng.lat;
        var clickedLng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker); // Remove existing marker
        }

        marker = L.marker([clickedLat, clickedLng]).addTo(map);

        document.getElementsByName("gps_lat")[0].value = clickedLat;
        document.getElementsByName("gps_long")[0].value = clickedLng;
    });
</script>


<?php require_once('../layouts/footer_to_end.php'); ?>