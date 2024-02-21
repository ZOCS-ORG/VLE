<?php
require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');
?>
<style>
    #map {
        height: 280px;
    }
</style>
<hr />
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<main>
    <div class="card-header text-center">
        <h3>School list</h3>
        <div class="text-right text-light">
            <a class="btn btn-sm btn-success" href="provinces.php"> Provinces <i class="fa fa-list "></i> </a>
            <a class="btn btn-sm btn-success" href="districts.php"> Distrricts <i class="fa fa-list "></i> </a>
            <!-- <a class="btn btn-sm btn-success" href="zones.php"> Zones <i class="fa fa-list "></i> </a> -->
            <a class="btn btn-sm btn-success" href="add_school.php"> Add School <i class="fa fa-plus "></i> </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>EMIS Number</th>
                        <th>School Name</th>
                        <th>School Location</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>Zone</th>
                        <th>Type of School</th>
                        <th>Map</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT s.*, z.zone, d.district_name, p.province_name FROM schools s
                                LEFT JOIN zones z ON z.zone_id = s.zone
                                LEFT JOIN districts d ON z.district_id = d.district_id
                                LEFT JOIN provinces p ON p.province_id = d.province_id";
                    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                    $string = "";
                    $images_dir = "../../../utils/images/students/";

                    while ($row = mysqli_fetch_array($res)) {
                        $picname = $row['img'];
                    ?>
                        <tr>
                            <td><?php echo $row['school_id']; ?> </td>
                            <td><?php echo $row['emis_number']; ?> </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['province_name']; ?></td>
                            <td><?php echo $row['district_name']; ?></td>
                            <td><?php echo $row['zone']; ?></td>
                            <td><?php echo $row['sch_type']; ?></td>
                            <td>
                                <a href="maps.php?sid=<?php echo $row['school_id']; ?>" class="map-link">
                                    <i class="fa fas fa-fw fa-map"></i>
                                </a>
                            </td>
                            <th>
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm text-light" href="./update_school.php?school_id=<?php echo $row["school_id"] ?>" >Edit </a>
                                    <a class="btn btn-danger btn-sm text-light" href="../../../config/admin_server.php?id=<?php echo $row["school_id"] ?>&delete_school=true" onclick="clicked(event)">Delete </a>
                                </div>
                            </th>
                        </tr>

                    <?php


                    }
                    ?>
                </tbody>
            </table>

            <div class="modal fade" id="mapsModal" tabindex="-1" role="dialog" aria-labelledby="mapsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mapsModalLabel">Maps</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="map"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>

    <script>
        var map = L.map('map').setView([-15.4089, 28.2871], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        map.on('click', function(e) {
            var clickedLat = e.latlng.lat;
            var clickedLng = e.latlng.lng;

            document.getElementsByName("gps_lat")[0].value = clickedLat;
            document.getElementsByName("gps_long")[0].value = clickedLng;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        function clicked(e) {
            if (!confirm('Are you sure you want to delete this ?')) {
                e.preventDefault();
            }
        }
    </script>
    </div>
    </div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>