<?php
require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');
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

<script>
    function loadDistricts() {
        var provinceId = document.getElementById("province").value;
        var districtSelect = document.getElementById("district");

        // Clear previous options
        districtSelect.innerHTML = "<option value=''>Select District</option>";

        // Load districts based on selected province
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
    }

    function loadZones() {
        var districtId = document.getElementById("district").value;
        var zoneSelect = document.getElementById("Zones");

        // Clear previous options
        zoneSelect.innerHTML = "<option value=''>Select Zone</option>";

        // Load zones based on selected district
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
    }
</script>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8" style="border: 1px solid #73AD21; ">
            <div class="card shadow-s border-0 rounded-lg mt-1">
                <?php
                if (isset($_POST['create_school_'])) {

                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $location = mysqli_real_escape_string($db, $_POST['address']);
                    $emis_number = mysqli_real_escape_string($db, $_POST['emis_number']);
                    $province = mysqli_real_escape_string($db, $_POST['province']);

                    $district = mysqli_real_escape_string($db, $_POST['district']);
                    $gps_lat = mysqli_real_escape_string($db, $_POST['gps_lat']);
                    $gps_long = mysqli_real_escape_string($db, $_POST['gps_long']);
                    $type = mysqli_real_escape_string($db, $_POST['type']);
                    $zone = mysqli_real_escape_string($db, $_POST['zone']);

                    $sql = "INSERT INTO schools ( `name`, `province`, `district`, `address`, `gps_lat`, `gps_long`, `emis_number`, `sch_type`, `zone`) 
                    VALUES('$name','$province','$district' , '$location','$gps_lat','$gps_long' ,'$emis_number','$type','$zone')";

                    $success = mysqli_query($db, $sql);
                    if (!$success) {
                        die('Could not enter data: ' . mysqli_error($db));
                    }
                    echo '   <h3 style=" background-color: green">A new school has been added successfully</h3>';
                }
                ?>
                <div class="card-header">
                    <h5 class="text-center my-2">Add New School</h5>
                </div>
                <div class="card-body" style=" border-color: black ">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="emis_number">Enter EMIS Number:</label>
                            <input id="emis_number" class="form-control" type="text" name="emis_number" placeholder="Enter EMIS Number" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Enter School Name:</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="Enter School Name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Enter School Address:</label>
                            <input id="address" class="form-control" type="text" name="address" placeholder="Enter School Address" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Select Province:</label>
                            <select id="province" name="province" class="form-control" onchange="loadDistricts()">
                                <option value="">Select Province</option>
                                <?php
                                $query = mysqli_query($db, "SELECT * FROM provinces");
                                if ($query) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo "<option value='{$row['province_id']}'>{$row['province_name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group" style="display: none;">
                            <label for="district"><b>Select District:</b></label>
                            <select id="district" name="district" class="form-control" onchange="loadZones()">
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="Zones"><b>Select Zone:</b></label>
                            <select id="Zones" name="zone" class="form-control">
                                <option value="">Select Zone</option>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="type">Type of School:</label>
                            <select id="type" name="type" class="form-control">
                                <option value="Primary School">Primary School</option>
                                <option value="University">University</option>
                                <option value="College">College</option>
                                <option value="Community School">Community School</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gps_lat">Enter GPS Latitude Location:</label>
                            <input id="gps_lat" class="form-control" type="text" name="gps_lat" placeholder="Enter Latitude Location">
                        </div>
                        <div class="form-group">
                            <label for="gps_long">Enter GPS Longitude Location:</label>
                            <input id="gps_long" class="form-control" type="text" name="gps_long" placeholder="Enter Longitude Location">
                        </div>
                        <div class="form-group">
                            <div id="map"></div>
                        </div>
                        <div class="form-group text-right">
                            <input class="btn btn-sm btn-success" type="submit" name="create_school_" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


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
<!-- End multi-select support  -->

<!-- <script>

var map = L.map('map').setView([-15.4089, 28.2871], 13); 

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


map.on('click', function(e) {
   
    var clickedLat = e.latlng.lat;
    var clickedLng = e.latlng.lng;

 
    alert("You clicked the map at: Latitude " + clickedLat + ", Longitude " + clickedLng);
});

</script> -->

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