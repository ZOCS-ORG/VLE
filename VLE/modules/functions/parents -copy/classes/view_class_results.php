<?php 
    require_once('../../../config/teacher_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $class_id = $_GET['class'];
    $get_class = "SELECT name FROM classes WHERE id = '$class_id' ";
    $class_res = mysqli_query($db,$get_class);
    $row = mysqli_fetch_assoc($class_res);
    $class_name = $row['name'];

    $results_name = $_GET['name'];

?>
 <hr/>

<main>
    <div class="container-fluid col-md-12">
        <div class=" mb-4">
            <div class="card-header text-center">
                <h4> <?php echo $class_name." ".$results_name; ?> Results</h4>
            </div>

    <div class="card mb-4">

        <div class="card-header">
            <div class="text-right text-light col-md-12">
                <a class="btn btn-sm btn-success" onClick="window.print()">Print report <i class="fas fa-print "></i> </a>
            </div>
        </div>
        <div class="card-body" id="print_it">
            <div class="table-responsive print-conten">
                <table class="table table-bordered" id="export" width="100%" cellspacing="4">
                    <thead>
                        <tr>
                            <th>Student</th>

                            <?php 
                                /** Create a loop to show all the subjects available for each student */
                                $query = "SELECT  * FROM results WHERE class_id = '$class_id' AND name = '$results_name' GROUP BY subject_id ";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($result) > 0){                   
                                    while($row = mysqli_fetch_assoc($result)){        
                                        echo "<th>Subject</th>";
                                        echo "<th>Marks</th>";
                                        echo "<th>Grade</th>";
                                        echo "<th>Comments</th>";
                                    }
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                $query = "SELECT  * FROM results WHERE class_id = '$class_id' AND name = '$results_name' ";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($result) > 0){                   
                                    while($row = mysqli_fetch_assoc($result)){        

                                    /** Get All students -row 1- */
                                    $student_id = $row['student_id'];
                                    $q = "SELECT name, id
                                            FROM students
                                            WHERE id = '$student_id' ";
                                    $res = mysqli_query($db, $q) or die(mysqli_error($db));
                                    if (mysqli_num_rows($res) > 0){
                                        while($r = mysqli_fetch_assoc($res)){ 
                                            $student_name = $r['name'];
                                            echo "<td><a  href='../students/view_student.php?id=".$r['id']."'>".$student_name."</a></td>";
                                        
                                            /** Create a loop to show all the subjects available for each student */
                                            $query_loop = "SELECT  * FROM results WHERE class_id = '$class_id' 
                                                        AND name = '$results_name' AND student_id = '$student_id' GROUP BY subject_id ";
                                            $result_loop = mysqli_query($db, $query_loop) or die(mysqli_error($db));
                                            $count = 1;
                                            if (mysqli_num_rows($result_loop) > 0){                   
                                                while($row_loop = mysqli_fetch_assoc($result_loop)){        

                                                    /** Get Subjects -row 2- */
                                                    $subject_id = $row_loop['subject_id'];
                                                    $q_subject = "SELECT name, id
                                                            FROM subjects
                                                            WHERE id = '$subject_id' ";
                                                    $res_subject = mysqli_query($db, $q_subject) or die(mysqli_error($db));
                                                    if (mysqli_num_rows($res_subject) > 0){
                                                        while($r_subject = mysqli_fetch_assoc($res_subject)){ 
                                                            $subject_name = $r_subject['name'];
                                                            echo "<th>".$subject_name."</th>";
                                                        }
                                                    }
                                                    /** Get Marks -Row 3- */
                                                    echo "<th>".$row_loop['marks']."</th>";
                                                    /** Get Grades -Row 4- set from system */
                                                    $value = $row_loop['marks'];
                                                    $grades_query = "SELECT * FROM grades";
                                                    $grades_res = mysqli_query($db,$grades_query);
                                                    while($grades_row = mysqli_fetch_assoc($grades_res)){
                                                        $min = $grades_row['min_value'];
                                                        $max = $grades_row['max_value'];
                                                        //echo $min;
                                                        if ( in_array($value, range($min,$max)) ) {
                                                            echo $grade = "<th>".$grades_row['name']."</th>";
                                                        }elseif($value < 0 & 100 < $value) {
                                                            echo  $grade = "Invalid percentage";
                                                        }
                                                    }

                                                    /** Get Comment -Row 5..final-  */
                                                    echo "<th>".$row_loop['comment']."</th>";

                                                }
                                            }
                                        
                                        
                                        }
                                    }
                            ?>
                        </tr>

                            <?php
                                    }
                                } else {
                                echo 'No results created for this class. Create a new entry';
                                }
                            ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    </div>
</main>


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
</script>

<style>
    /* Print the form, only */
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
    width: 85%;
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
    var btn = document.getElementById("create_results_model");

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
