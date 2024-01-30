<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $student_id = $_GET['id'];
    $term = "";//$_GET['term'];
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
                                <p class="text-primary"><?php echo $r_class['name']; ?> </p>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Tuition Fees</p>
                            </div>
                        </div>
                        <div > <hr ></div>
                        <div class="col-lg-5">
                            <div class="">

                                <?php
                                    // First get latest paiment to determine the current term.
                                    $latest_fees_query = mysqli_query($db, "SELECT * FROM fees WHERE student_id = '$student_id'
                                                ORDER BY fees.date_paid DESC LIMIT 1 " )or die("An error occured: ".mysqli_error($db));
                                    if(mysqli_num_rows($latest_fees_query) == 1){
                                        while($latest_fees_row = mysqli_fetch_assoc($latest_fees_query)){
                                        $get_term = $latest_fees_row['term'];
                                        $current_term = "Term ".$get_term.", $year "; 
                                        }
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
                                    }
                                ?>
                            </div>

                        </div>


                        <!-- <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Other Payments</p>
                            </div>
                        </div>
                        <div > <hr style=""></div>
                        <div class="col-lg-5">
                            <div class="">                                
                                <p class="h6 mb-0">
                                <a class="fas" href='../../reports/payments_report.php?stud_id=<?php //echo $student_id ?>'>
                                View Report <i class="fas fa fa-download"></i> </a>
                                </p>
                            </div>

                        </div> -->



                    </div>
                    </div>

<br class="mb-4 py-2">
        <div class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5 bg-dark">
            <p class="h5 mb-0 text-white">Payment history <span style="padding-left:50px">
                <a class="fas" href='../../reports/student_fees_report.php?stud_id=<?php echo $student_id ?>'>
                Report <i class="fas fa fa-download"></i> </a> </span>
            </p>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-10 mx-auto mb-4">

                <?php 
                    /** Get the the payment history of all terms and create tables for each term 
                     * term $current_term */

                    $all_terms_query = mysqli_query($db, "SELECT * FROM fees WHERE student_id = '$student_id'
                        GROUP BY term " )or die("An error occured: ".mysqli_error($db));
                    if(mysqli_num_rows($all_terms_query) > 0){
                    while($all_terms_row  = mysqli_fetch_assoc($all_terms_query) ){
                        $term = $all_terms_row['term'];
                        $get_term = $all_terms_row['term'];
                        $term_full = "Term ".$get_term.", $year ";
                ?>  
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-uppercase text-primary"><?php echo $term_full; ?></h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Date Paid</th>
                                    <th>Amount</th>
                                    <th>Paid Via</th>
                                    <th>Account/Recieved By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <?php 
                                        /** Get the the payment history paid in the term $current_term */
                                        $total_query = mysqli_query($db, "SELECT SUM(amount) FROM fees WHERE student_id = '$student_id'
                                            AND term = '$term' " )or die("An error occured: ".mysqli_error($db));
                                        while($total_row  = mysqli_fetch_assoc($total_query) ){
                                            $total = $total_row['SUM(amount)'];
                                        }

                                        $term_fee_history_query = mysqli_query($db, "SELECT amount,date_paid,method,bank_acc, recieved_by 
                                              FROM fees WHERE student_id = '$student_id'
                                            AND term = '$term' " )or die("An error occured: ".mysqli_error($db));
                                        if(mysqli_num_rows($term_fee_history_query) >= 1){
                                        while($term_fee_history_row  = mysqli_fetch_assoc($term_fee_history_query) ){
                                            $amount_paid = $term_fee_history_row['amount'];
                                            $method = $term_fee_history_row['method'];
                                            $date_paid = $term_fee_history_row['date_paid'];
                                            if($get_term == 1){ 
                                                $date_due_raw =  $date_due_1;
                                            }elseif($get_term == 2){ 
                                                $date_due_raw =  $date_due_2;
                                            }elseif($get_term == 3){ 
                                                $date_due_raw =  $date_due_3;
                                            }
                                            $raw_date = strtotime($date_due_raw);
                                            $date_due = date("d F, Y", $raw_date);
                                    ?>
                                    <?php echo "<td>".$date_paid."</td>"; /** Date paid - Row 1 */
                                        echo "<td>$currency ".number_format("$amount_paid",2)."</td>"; /**Amount - Row 2 */
                                        echo "<td>".$method."</td>"; /** Method - Row 3 */
                                        /** Handle method */
                                        if($method == 'Bank'){
                                          $acc = $term_fee_history_row['bank_acc'];
                                          $get_bank_query = mysqli_query($db, "SELECT * FROM banks WHERE id = '$acc' LIMIT 1 ");
                                          $get_bank_row = mysqli_fetch_assoc($get_bank_query);
                                          echo "<td>".$get_bank_row['name']."</td>"; /** Method if paid Bank - Row 4 */
                                        }elseif($method == 'Cash'){
                                          $acc = $term_fee_history_row['recieved_by'];
                                          $get_bank_query = mysqli_query($db, "SELECT * FROM accountants WHERE id = '$acc' LIMIT 1 ");
                                          $get_bank_row = mysqli_fetch_assoc($get_bank_query);
                                          echo "<td>".$get_bank_row['name']."</td>"; /** Method if paid by cash - Row 4 Alt */
                                        }else{ echo "<td> Unknown </td>"; /** If neither - Row 4 Default */ }

                                    ?>

                                </tr>

                                    <?php
                                            }
                                        } else {
                                        echo 'Payments not found';
                                        }
                                    ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th><?php echo "$currency ".number_format($total,2); ?></th>
                                    <th></th>
                                </tr>
                            </ttoot>
                        </table>
                    </div>

                </div>

                              <?php
                            }
                        }
                    ?>  
          </div>

        </div>
        <!-- /.container-fluid -->



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
