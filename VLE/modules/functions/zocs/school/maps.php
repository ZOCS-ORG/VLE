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

    #map { height: 280px;  }
</style>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8" style="border: 1px solid #73AD21; ">
            <div class="card shadow-s border-0 rounded-lg mt-1">
              
                <div class="card-header">
              <?php 
              $sid = $_GET['sid'];
              $sql ="SELECT name, gps_lat, gps_long FROM schools WHERE school_id = $sid";
              $maps = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
              $row = mysqli_fetch_array($maps);
              ?>
                    <h5 class="text-center my-2"><?php echo $row['name']; ?> location</h5>
                </div>
                <div class="card-body" style=" border-color: black ">
                <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Multi-Select suport -->
<link rel="stylesheet" href="../../../assets/select_box/vanillaSelectBox.css">
<script src="../../../assets/select_box/vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#subj", {
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        disableSelectAll: true,
        placeHolder: "Assign subjects",
    });
</script>




<script>

var lat = <?php echo $row['gps_lat']; ?>;
var lng = <?php echo $row['gps_long']; ?>; 
var map = L.map('map').setView([lat, lng], 13); 

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var marker = L.marker([lat, lng]).addTo(map);

map.on('click', function(e) {
    
    var clickedLat = e.latlng.lat;
    var clickedLng = e.latlng.lng;

   
    document.getElementsByName("gps_lat")[0].value = clickedLat;
    document.getElementsByName("gps_long")[0].value = clickedLng;
});

</script>



<?php require_once('../layouts/footer_to_end.php'); ?>