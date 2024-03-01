<?php
      //set to false if you don't want the sidebar to show
      $add_side_bar = true;
      require_once('../layouts/head_to_wrapper.php'); 
?>
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
          <?php include('../layouts/topbar.php') ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid" style="padding:0 50px">
        <?php
            // First get latest paiment to determine the current term.
            $latest_fees_query = mysqli_query($db, "SELECT * FROM fees WHERE student_id = '$id'
                        ORDER BY fees.date_paid DESC LIMIT 1 " )or die("An error occured: ".mysqli_error($db));
            if (mysqli_num_rows($latest_fees_query) > 0) {
            
              while($latest_fees_row = mysqli_fetch_assoc($latest_fees_query)){
                $get_term = $latest_fees_row['term'];
                $current_term = "Term ".$get_term.", $year ";
              }
              /** Get the total amount paid in the term $current_term */
              $term_fees_query = mysqli_query($db, "SELECT SUM(amount) FROM fees WHERE student_id = '$id'
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
        ?>
        
          <!-- Feeds Heading -->
          <div class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5 bg-dark">
            <h5 class="h5 mb-0 text-white ">My Fees </h5>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-7 col-md-7 mb-3 mx-auto">
              <div class="card border-info shadow py-4">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm h6 text-dark text-uppercase text-justify mb-1">
                        <?php echo "Total amount paid for ".$current_term." is $currency ".number_format($total_amount_paid).",
                                    out of the expected $currency ".number_format($total_term_fees);?>
                      </div>
                      <br>
                      <div class="text- h5 mb-5 text-justify font-weight-bold"> 
                        <?php
                            /**Get the difference */
                            $balance_due = $total_term_fees - $total_amount_paid;
                            if($balance_due == 0 ){
                                echo "<p>You have no outstanding fees for this term <p>";
                            }elseif($balance_due > 0){
                                echo "<p class='text-danger'>Your outstanding balance for the term is $currency ". number_format($balance_due,2) ."<p>";
                                echo "<p>Kindly settle the ballance before $date_due";
                            }elseif($balance_due < 0){
                                echo "<p class='text-success'>You have an unallocated amount of $currency ".abs(number_format($balance_due))."
                                    Contact the accounts office to transfer the amount onto next term, or to claim it <p>";
                            }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <hr>

          <!-- Feeds Heading -->
          

          <?php } else{ 
                echo "<div class='card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5 bg-primary'>
                      <h5 class='h5 mb-0 text-white '> No tuition fee payments found! </h5>
                    </div>";
          } ?>


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->

            <div class="col-lg-10 mb-4">

                <?php 
                    /** Get the the payment history of all terms and create tables for each term 
                     * term $current_term */

                    $all_terms_query = mysqli_query($db, "SELECT * FROM fees WHERE student_id = '$id'
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
                                        $total_query = mysqli_query($db, "SELECT SUM(amount) FROM fees WHERE student_id = '$id'
                                            AND term = '$term' " )or die("An error occured: ".mysqli_error($db));
                                        while($total_row  = mysqli_fetch_assoc($total_query) ){
                                            $total = $total_row['SUM(amount)'];
                                        }

                                        $term_fee_history_query = mysqli_query($db, "SELECT amount,date_paid,method,bank_acc, recieved_by 
                                              FROM fees WHERE student_id = '$id'
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
                                          echo "<td>".$get_bank_row['name']."</td>"; /** Method - Row 3 */
                                        }elseif($method == 'Cash'){
                                          $acc = $term_fee_history_row['recieved_by'];
                                          $get_bank_query = mysqli_query($db, "SELECT * FROM accountants WHERE id = '$acc' LIMIT 1 ");
                                          $get_bank_row = mysqli_fetch_assoc($get_bank_query);
                                          echo "<td>".$get_bank_row['name']."</td>"; /** Method - Row 3 Alt */
                                        }else{ echo "<td> Unknown </td>"; /** If neither - Row 3 Default */ }
                                    ?>

                                </tr>

                                    <?php
                                            }
                                        } else {
                                        echo 'Payment history not found';
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
      <!-- End of Main Content -->

      </div>
     <?php
      require_once('../layouts/footer_to_end.php');
     ?>