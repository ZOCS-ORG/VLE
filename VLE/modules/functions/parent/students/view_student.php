<?php 
    require_once('../../../config/parent_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

        $id = $_GET['id'];
        $query = "SELECT  * from students where id = '$id' ";

        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $count = 1;
        if (mysqli_num_rows($result) > 0){
            $images_dir = "../../../utils/images/students/";
                
            while($row = mysqli_fetch_assoc($result)){ 
                $picname = $row['img'];
?>
<hr/>
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
                                <p> <?php echo $r_class['name']; ?> </p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Fees</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <?php
                                    // First get latest paiment to determine the current term.
                                    $latest_fees_query = mysqli_query($db, "SELECT * FROM fees WHERE student_id = '$id'
                                                ORDER BY fees.date_paid DESC LIMIT 1 " )or die("An error occured: ".mysqli_error($db));
                                    if(mysqli_num_rows($latest_fees_query) >= 1){
                                        while($latest_fees_row = mysqli_fetch_assoc($latest_fees_query)){
                                        $get_term = $latest_fees_row['term'];
                                        $current_term = "Term ".$get_term.", $year "; 
                                        }
                                        /** Get the total amount paid in the term $current_term */
                                        $term_fees_query = mysqli_query($db, "SELECT SUM(amount) 
                                                                FROM fees WHERE student_id = '$id'
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
                                    }elseif(mysqli_num_rows($latest_fees_query) == 0){ 
                                        echo "<p class='text-danger'>Payments not found! </p>"; 
                                    }
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
                                $q_results = "SELECT  name, id,date FROM results WHERE student_id = '$id' GROUP BY name ";

                                $res_results = mysqli_query($db, $q_results) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($res_results) > 0){                   
                                    while($r_res = mysqli_fetch_assoc($res_results)){        
                                    // <!-- Fomart date  -->
                                    $date = strtotime($r_res['date']);
                                    $date_fmtd = date('d F,Y',$date); 
                                    
                                    $name = $r_res['name'];
                                    echo "<div class='nav nav-link'>- <a href='../../reports/student_grades_report.php?name=$name&stud_id=$id'>"
                                    .$name."</a> | ".$date_fmtd."</div>";
                            ?> 
                                

                            <!-- <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_subject.php?id=<?php echo $row['id']?>">Edit</a> 
                                <a class="btn btn-danger btn-sm text-light disabled" href="#">Delete </a>
                            </th> -->

                            <?php
                                    }
                                } elseif (mysqli_num_rows($res_results) == 0) {
                                    echo "<p class='text-danger'>Results not found! </p>"; 
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
                                    $query ="SELECT subjects.name, subjects.id
                                            FROM subjects
                                            INNER JOIN student_subjects ON subjects.id = student_subjects.subject_id
                                            WHERE student_id = '$id' ";
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

<?php require_once('../layouts/footer_to_end.php'); ?>
