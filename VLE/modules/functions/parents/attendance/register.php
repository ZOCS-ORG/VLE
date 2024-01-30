<?php 
    require_once('../../../config/parent_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    // $class_id = $_GET['class'];
    // $get_class = "SELECT name FROM classes WHERE id = '$class_id' ";
    // $class_res = mysqli_query($db,$get_class);
    // $row = mysqli_fetch_assoc($class_res);
    // $student_name = $row['name'];

    $student_id = $_GET['student'];
    $get_student = "SELECT name FROM students WHERE id = '$student_id' ";
    $student_res = mysqli_query($db,$get_student);
    $row = mysqli_fetch_assoc($student_res);
    $student_name = $row['name'];


?>

        <hr/>
        


        <main>
            <div class="container-fluid col-md-9">
                <div class=" mb-4">
                    <div class="card-header text-center">
                        <h3> <?php echo $student_name; ?> class attendance</h3>
                    </div>

            <div class="card mb-4">

                <div class="card-header">
                    <div class="text-right text-light col-md-12">
                        <a class="btn btn-sm btn-success" onClick="window.print()">Report <i class="fas fa-print "></i> </a>
                    </div>
                </div>
                <div class="card-body" id="print_it">
                    <div class="table-responsive print-conten">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Teachers Name</th>
                                    <th>Attendance</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $query = "SELECT * from attendance WHERE student_id = '$student_id' ORDER BY `attendance`.`date` DESC ";

                                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                        $count = 1;
                                        if (mysqli_num_rows($result) > 0){                   
                                            while($row = mysqli_fetch_assoc($result)){        

                                            $teacher_id = $row['teacher_id'];
                                            $tea_q = "SELECT name, id
                                                    FROM teachers
                                                    WHERE id = $teacher_id";
                                            $res = mysqli_query($db, $tea_q) or die(mysqli_error($db));
                                            if (mysqli_num_rows($res) > 0){
                                                while($r = mysqli_fetch_assoc($res)){ 
                                                    $teacher_name = $r['name'];
                                                    echo "<td><a  href='../lecturers/view_lecturer.php?id=".$r['id']."'>".$teacher_name."</a></td>";
                                                }
                                            }
                                    ?>

                                        <!-- Attendance Status -->
                                        <td>
                                            <?php
                                                $status = $row['status'];
                                                if($status == 'Present'){
                                                    echo "<div class='text-center'><span style='padding:5px' class='btn-success rounded-circle'>".$status."</span></div>";
                                                }elseif ($status == 'Absent') {
                                                    echo "<div class='text-center'><span style='padding:5px' class='btn-danger rounded-circle'>".$status."</span></div>";
                                                }
                                            ?> 
                                        </td>
                                        <!-- Fomart date  -->
                                        <td>
                                             <?php 
                                                $date = strtotime($row['date']);
                                                $date_fmtd = date('D - d M,Y',$date); 
                                                echo $date_fmtd;
                                             
                                             ?> 
                                        </td>


                                    <!-- <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_subject.php?id=<?php echo $row['id']?>">Edit</a> 
                                        <a class="btn btn-danger btn-sm text-light disabled" href="#">Delete </a>
                                    </th> -->
                                </tr>

                                    <?php
                                            }
                                        } else {
                                        echo 'No Records Found!';
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
                } );
            </script>








            </div>
        </main>





<style>

@media print {
  body * {
    visibility: hidden;
  }
  #print_it, #print_it * {
    visibility: visible;
  }
  #print_it {
    position: absolute;
    left: 0;
    top: 0;
  }
}


    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
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
    var btn = document.getElementById("register_model");

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
