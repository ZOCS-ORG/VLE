<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');

?>

<hr />
<main>
    <div class="card-header text-center">
        <h3>Our Kids</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>





                <!-- Results's Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>

                        <?php
                        // $parent_id = $row['parentid'];
                        // $q = "SELECT 
                        // parents.mothername, parents.fathername, parents.id
                        // FROM parents
                        // WHERE id = $parent_id";

                        // $res = mysqli_query($db, $q) or die(mysqli_error($db));

                        // if (mysqli_num_rows($res) > 0){
                        //     while($r = mysqli_fetch_assoc($res)){ 
                        //         echo "<p>Fathers name: ".$r['fathername'].".</p>";
                        //         echo "<p>Mothers name: ".$r['mothername'].".</p>";
                        //         echo "<p><a class='btn btn-info btn-sm' href='../parents/view_parent.php?id=".$row['parentid']."'>View.</a></p>";
                        //     }
                        // }
                        ?>

                    </div>
                </div>
                <!-- Results's Modal Ends -->





                <tbody>
                    <?php
                    $sql = "SELECT img, students.name AS name, students.id AS id, classes.name AS class FROM students INNER JOIN classes ON classes.id = students.class_id WHERE parentid = '$id' ";
                    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                    $string = "";
                    $images_dir = "../../../utils/images/students/";

                    while ($row = mysqli_fetch_array($res)) {
                        $picname = $row['img'];
                    ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['class']; ?></td>
                            <td><?php echo "<img src='" . $images_dir . $picname . "' alt='" . $picname . "' width='50' height='50'> " ?></td>
                            <td>
                                <div class="btn-group"><a class="btn btn-success btn-sm text-white" href="view_student.php?id=<?php echo $row['id'] ?>">View Student</a>
                                    <a class="btn btn-warning btn-sm text-dark " href="../attendance/register.php?student=<?php echo $row['id'] ?>">View Attendance </a>
                                    <a class="btn btn-sm btn-primary" href="../../../../lms/student/stud_profile.php?student_id=<?php echo $row['id'] ?>">
                                        <span>E-Learning </span></a>
                            </td>
        </div>

        </tr>
    <?php

                    }

    ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>


    </div>
    </div>
</main>



<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 3px solid lightblue;
        width: 40%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("parent_model");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


<?php require_once('../layouts/footer_to_end.php'); ?>