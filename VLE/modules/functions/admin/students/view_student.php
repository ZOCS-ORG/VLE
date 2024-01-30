<?php 
    require_once('../scripts/student_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $student_id = $_GET['id'];

?>
    <hr/>
    <?php 
        $query = "SELECT  * from students where id = '$student_id' ";

        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $count = 1;
        if (mysqli_num_rows($result) > 0){
            $images_dir = "../../../utils/images/students/";
                
            while($row = mysqli_fetch_assoc($result)){ 
                $picname = $row['img'];
    ?>

    <main>
        <div class="container-fluid col-md-9">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>Students Info</h3>
                    <?php echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='140' height='140'> "?>
                </div>
                
                <div class="">
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 style="color:lightblue" class="text-right"> Personal Info </h5> <hr>
                            <div class=" text-right">
                                <p>ID</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <h5 style="color: transparent"> Personal Info</h5> <hr>
                            <div class="">
                                <p><?php echo $row['id']; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Name</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p><?php echo $row['name']; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Username</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p><?php echo $row['username']; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Gender.</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p> <?php echo $row['sex']; ?> </p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Date of Birth.</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p> <?php echo $row['dob']; ?> </p>
                            </div>
                        </div>

                        <!-- Parent's Modal -->
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    
                                    <?php 
                                        $parent_id = $row['parentid'];
                                        $q = "SELECT 
                                        parents.mothername, parents.fathername, parents.id
                                        FROM parents
                                        WHERE id = $parent_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                echo "<p>Fathers name: ".$r['fathername'].".</p>";
                                                echo "<p>Mothers name: ".$r['mothername'].".</p>";
                                                echo "<p><a class='btn btn-info btn-sm' href='../parents/view_parent.php?id=".$row['parentid']."'>View.</a></p>";
                                            }
                                        }
                                    ?>

                                </div>
                            </div>
                        <!-- Parent's Modal Ends -->

                        <div class="col-lg-6">
                            <h5 style="color:lightblue" class="text-right"> Contact Info </h5> <hr>
                            <div class=" text-right">
                                <p>Parents</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <h5 style="color: transparent"> Contact Info</h5> <hr>
                            <div class="">
                                <p><button class="btn btn-sm btn-info" id="parent_model"> (o_o)</button> </p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Phone Number</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p><?php echo $row['phone']; ?></p>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Email</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p><?php echo $row['email']; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Address.</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p> <?php echo $row['address']; ?> </p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h5 style="color:lightblue" class="text-right"> Academic Info</h5> <hr>
                            <div class=" text-right">
                                <p>Admission Date</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <h5 style="color: transparent"> Academic Info</h5> <hr>
                            <div class="">
                                <p><?php echo $row['addmissiondate']; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Class</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <?php 
                                    $class_id = $row['class_id'];
                                    $q_class = "SELECT name, id FROM classes WHERE id = '$class_id' ";
                                    $res_class = mysqli_query($db,$q_class);
                                    $r_class = mysqli_fetch_assoc($res_class);
                                ?>
                                <p><a href="../classes/view_class.php?id=<?php echo $class_id ?>"><?php echo $r_class['name']; ?> </a></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Fees.</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <?php
                                    // First get latest payment to determine the current term.
                                    $latest_fees_query = mysqli_query($db, "SELECT * FROM fees WHERE student_id = '$student_id'
                                                ORDER BY fees.date_paid DESC LIMIT 1 " )or die("An error occured: ".mysqli_error($db));
                                    if(mysqli_num_rows($latest_fees_query) == 1){
                                        while($latest_fees_row = mysqli_fetch_assoc($latest_fees_query)){
                                        $get_term = $latest_fees_row['term'];
                                        $current_term = "Term ".$get_term.", $year "; 
                                        }
                                        // return var_dump($latest_fees_query);

                                        /** Get the total amount paid in the term $current_term */
                                        $term_fees_query = mysqli_query($db, "SELECT SUM(amount) 
                                                                FROM fees WHERE student_id = '$student_id'
                                                            AND term = '$get_term' " )or die("An error occured: ".mysqli_error($db));
                                        while($term_fees_row  = mysqli_fetch_assoc($term_fees_query) ){
                                            $total_amount_paid = $term_fees_row['SUM(amount)'];
                                            /**Get due date for current term */
                                            if($get_term == 1){ 
                                                $date_due_raw =  $date_due_1;
                                            }elseif($get_term == 2){ 
                                                $date_due_raw =  $date_due_2;
                                            }elseif($get_term == 3){ 
                                                $date_due_raw =  $date_due_3;
                                            }
                                            $raw_date = strtotime($date_due_raw);
                                            $date_due = date("d F, Y", $raw_date);
                                        }
                                        echo "Total amount paid for ".$current_term." is $currency ".number_format($total_amount_paid,2).",
                                            out of the expected $currency ".number_format($total_term_fees);
                                        /**Get the difference */
                                        $balance_due = $total_term_fees - $total_amount_paid;
                                        if($balance_due == 0 ){
                                            echo "<p>Student has no outstanding fees for this term <p>";
                                        }elseif($balance_due > 0){
                                            echo "<p class='text-danger'>Student's outstanding balance for the term is $currency ".number_format($balance_due,2)." <p>";
                                            echo "<p>Due date for payments is $date_due";
                                        }elseif($balance_due < 0){
                                            echo "<p class='text-success'>Student, therefore, has an allocated amount of $currency ".abs(number_format($balance_due));
                                        }
                                    }else{ echo "Fees not found!"; }
                                ?>
                                
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Results.</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">

                            <?php 
                                $q_results = "SELECT  name, id,date FROM results WHERE student_id = '$student_id' GROUP BY name ";

                                $res_results = mysqli_query($db, $q_results) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($res_results) > 0){                   
                                    while($r_res = mysqli_fetch_assoc($res_results)){        
                                    // <!-- Fomart date  -->
                                    $date = strtotime($r_res['date']);
                                    $date_fmtd = date('d F,Y',$date); 
                                    
                                    $name = $r_res['name'];
                                    echo "<div class='nav nav-link'>- <a href='../../reports/student_grades_report.php?name=$name&stud_id=$student_id'>"
                                    .$name."</a> | ".$date_fmtd."</div>";
                            ?> 
                                

                            <!-- <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_subject.php?id=<?php echo $row['id']?>">Edit</a> 
                                <a class="btn btn-danger btn-sm text-light disabled" href="#">Delete </a>
                            </th> -->

                            <?php
                                    }
                                }  
                            ?> 
                                    

                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Subjects</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">

                                <?php
                                    $query ="SELECT subjects.id, subjects.name
                                            FROM subjects
                                            INNER JOIN student_subjects ON subjects.id = student_subjects.subject_id
                                            WHERE student_id = '$student_id' ";
                                    $results = mysqli_query($db, $query)or die('Error getting data: '. mysqli_error($db));
                                    while($row_sub = mysqli_fetch_array($results)){
                                        $subject_name = $row_sub['name'];
                                        $subject_id = $row_sub['id'];
                                        echo "<span class='text-primary'>".$subject_name."</span> | ";
                                    }
                                ?>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                            </div>
                        </div>
                        <div > <hr style="width:1px; background-color:grey; "></div>
                        <div class="col-lg-5">
                        <div class="text-right text-white">
                            <a href="update_student.php?id=<?php echo $student_id ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="../../../config/admin_server.php?id=<?php echo $student_id;?>&delete_student=true" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                        </div>

                    </div>
                    </div>



            </div>
        </div>
    </main>
    <?php
            }
        } else {
        echo 'Invalid ID';
        }
    ?>

<style>
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
