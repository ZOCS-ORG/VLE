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



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8" style="border: 1px solid #73AD21; ">
            <div class="card shadow-s border-0 rounded-lg mt-1">
                <?php
                $school_id = $_GET['school_id'];
                if (isset($_POST['update'])) {

                    $emis_number = mysqli_real_escape_string($db, $_POST['emis_number']);
                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $address = mysqli_real_escape_string($db, $_POST['address']);
                    $zone = mysqli_real_escape_string($db, $_POST['zone']);

                    $type = mysqli_real_escape_string($db, $_POST['type']);
                    $gps_lat = mysqli_real_escape_string($db, $_POST['gps_lat']);
                    $gps_long = mysqli_real_escape_string($db, $_POST['gps_long']);

                    //? update schools with above data

                    $sql = "UPDATE schools SET `name` = '$name', `address` = '$address', `zone` = '$zone', `sch_type` = '$type',
                                    `gps_lat` = '$gps_lat', `gps_long` = '$gps_long', `emis_number` = '$emis_number'
                                    WHERE `school_id` = '$school_id' ";
                    $success = mysqli_query($db, $sql);
                    if (!$success) {
                        die('Could not enter data: ' . mysqli_error($db));
                    }

                    $success = mysqli_query($db, $sql);
                    if (!$success) {
                        die('Could not enter data: ' . mysqli_error($db));
                    }
                    echo '   <h3 style=" background-color: green">A new school has been added successfully</h3>';
                }

                // get school info from database
                $query = mysqli_query($db, "SELECT * FROM schools WHERE `school_id` = '$school_id' ") or die('Could not fetch data: ' . mysqli_error($db));
                $row = mysqli_fetch_array($query);
                // assign values for the following values emis_number name address zone type gps_lat gps_long
                $emis_number = $row['emis_number'];
                $name = $row['name'];
                $address = $row['address'];
                $zone = $row['zone'];
                $type = $row['sch_type'];
                $gps_lat = $row['gps_lat'];
                $gps_long = $row['gps_long'];


                ?>
                <div class="card-header">
                    <h5 class="text-center my-2">Update School</h5>
                </div>
                <div class="card-body" style=" border-color: black ">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <table class="table" id="" width="100%" cellspacing="9">
                            <tr>
                                <td style=" color: black"><b>Enter EMIS Number:</b></td>
                                <td class="text-right"><input type="text" name="emis_number" value="<?php echo $emis_number ?>" placeholder="Enter EMIS Number" required=""></td>
                            </tr>
                            <tr>
                                <td style=" color: black"><b>Enter School Name:</b></td>
                                <td class="text-right"><input type="text" name="name" value="<?php echo $name ?>" placeholder="Enter School Name" required=""></td>
                            </tr>

                            <tr>
                                <td style=" color: black"><b>Enter School Address:</b></td>
                                <td class="text-right"><input type="text" name="address" value="<?php echo $address ?>" placeholder="Enter School Address" required=""></td>
                            </tr>

                            <tr>
                                <td style=" color: black"><b>Select Zone:</b></td>
                                <td class="text-right">
                                    <select name="zone" value="<?php echo $zone ?>" id="zone">
                                        <?php
                                        $q = mysqli_query($db, "SELECT * FROM zones");
                                        if (!$q) {
                                            die('Could not enter data: ' . mysqli_error($db));
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>
                                            <option value="<?php echo $row['zone_id']; ?>"><?php echo $row['zone']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style=" color: black"><b>Type of School:</b></td>
                                <td class="text-right">
                                    <select name="type" value="<?php echo $type ?>" id="">
                                        <option value="University">University </option>
                                        <option value="College">College </option>
                                        <option value="Community School">Community School </option>
                                        <option value="Primary School ">Primary School </option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style=" color: black"><b>Enter GPS Latitude Location</td>
                                <td class="text-right"><input type="text" name="gps_lat" value="<?php echo $gps_lat ?>" placeholder="Enter Latitude  Location"></td>
                            </tr>

                            <tr>
                                <td style=" color: black"><b>Enter GPS longitude Location:</b></td>
                                <td class="text-right"><input type="text" name="gps_long" value="<?php echo $gps_long ?>" placeholder="Enter longitude  Location"></td>
                            </tr>

                            <tr>
                                <td id="map"></td>
                            </tr>


                            <td></td>

                            <td class="text-right"><input class="btn btn-sm btn-success " type="submit" name="update" value="Submit"></td>

                        </table>
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