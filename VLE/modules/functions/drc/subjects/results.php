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

    $subject_id = $_GET['subject'];
    $get_subject = "SELECT name FROM subjects WHERE id = '$subject_id' ";
    $subject_res = mysqli_query($db,$get_subject);
    $row = mysqli_fetch_assoc($subject_res);
    $subject_name = $row['name'];

?>
 <hr/>

<main>
    <div class="container-fluid col-md-9">
        <div class=" mb-4">
            <div class="card-header text-center">
                <h4> <?php echo $class_name." ".$subject_name; ?> Results</h4>
            </div>

    <div class="card mb-4">

        <!-- Add results Modal -->
            <form method="POST" action="#">
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="row">
                            <label class="col-md-4 text-right">Class & Subject <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <?php 
                                echo '<label>'.$class_name.', '.$subject_name.'</label>';
                                ?>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <label class="col-md-4 text-right">Date <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                        readonly placeholder="<?php echo date('D, Y-m-d') ?>">
                                <span id="error_attendance_date" class="text-danger"></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <label class="col-md-4 text-right">Name of results being created <span class="text-danger">*</span></label>
                            <div class="col-md-8 col-lg-8">
                                <input type="text" name="name" placeholder="e.g Mid-term, End of Year, etc." required />
                                <span id="error_attendance_date" class="text-danger"></span>
                            </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="student_register" width="100%" cellspacing="">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Student Name</th>
                                            <th>Percentage</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php 
                                                /**
                                                 * @TODO: GET RESULTS OF ONLY THE STUDENTS IN A CLASS WHO TAKE A SPECIFIC
                                                 *        SUBJECT BY DOING A KA JOIN🔗⏰⏰. NOT EVERYONE IN A CLASS
                                                 */
                                                $query = "SELECT  name,id FROM students WHERE class_id = '$class_id'";
                                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                                $count = 1;
                                                if (mysqli_num_rows($result) > 0){                   
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $student_name = $row['name'];
                                                        $student_id = $row['id'];

                                                        //return var_dump($students);
                                                        echo "<td><input name='students[]' type='hidden' value='".$student_id."'>".$student_id." </input></td>";
                                                        echo "<td>".$student_name."</td>";
                                                        //echo "Check";
                                            ?>
                                            <td><input name="marks[]" class="custom-control-label" type="number" /></td>
                                            <td><input name="comment[]" type="text" placeholder="Comment" /></td>
                                        </tr>
                                            <?php
                                                    }
                                                } else {
                                                    echo 'Students Not found for this subject';
                                                }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- Other Hidden data and Submit -->
                        <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
                        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
                        <input type="submit" name="submmit_results" id="button_action" class="btn btn-success btn-sm" value="Add" />
                        <span type="button" class="close btn btn-danger btn-sm">Close</span>
                    </div>




                </div>
            </div>
            </form>
        <!-- Add Results Model Ends -->

        <div class="card-header">
            <div class="text-right text-light col-md-12">
                <a class="btn btn-sm btn-success" onClick="window.print()">Print report <i class="fas fa-print "></i> </a>
                <a class="btn btn-sm btn-success" id="create_results_model"> Record new results  <i class="fas fa-file "></i> </a>
            </div>
        </div>
        <div class="card-body" id="print_it">
            <div class="table-responsive print-conten">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                    <thead>
                        <tr>
                            <th>Results</th>
                            <th>Date Recorded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                $query = "SELECT  name, id,date FROM results WHERE class_id = '$class_id' AND subject_id = '$subject_id' GROUP BY name ";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($result) > 0){                   
                                    while($row = mysqli_fetch_assoc($result)){        
                            ?>

                                <!-- Results grouped by name -->
                                <td>
                                    <?php
                                        $name = $row['name'];
                                        echo "<div class='text-center'>
                                            <a href='../results/view_results.php?subject=$subject_id&class=$class_id&name=$name'>".$name."</a></div>";
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
