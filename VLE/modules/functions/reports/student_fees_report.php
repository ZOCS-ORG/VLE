<?php
    session_start();
    include('../../utils/vars.php');
    require_once('../../config/config.php');

    $id = $_SESSION['id'];
    
    $student_id = $_GET['stud_id'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Tuition Fees Report</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/sb-admin-2.min.css" rel="stylesheet">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <style>
        body {
            font-family: "Roboto", Helvetica, Arial, sans-serif;
            font-weight: 100;
            font-size: 12px;
            line-height: 30px;
            color: #777;
            background: #fff
        }

        .container {
            max-width: 1100px;
            width: 100%;
            margin: 0 auto;
            position: relative
        }

        #contactus {
            font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
            background: #F9F9F9;
            padding: 25px;
            margin: 50px 0;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24)
        }

        #contactus {}

        #contactus h3 {
            display: block;
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 10px
        }

        #contactus h4 {
            margin: 5px 0 15px;
            display: block;
            font-size: 13px;
            font-weight: 400
        }

        fieldset {
            border: medium none !important;
            margin: 0 0 10px;
            min-width: 100%;
            padding: 0;
            width: 100%
        }

        #contactus input[type="text"],
        #contactus input[type="email"],
        #contactus input[type="tel"],
        #contactus input[type="url"],
        #contactus textarea {
            width: 100%;
            border: 1px solid #ccc;
            background: #FFF;
            margin: 0 0 5px;
            padding: 10px
        }

        #contactus input[type="text"]:hover,
        #contactus input[type="email"]:hover,
        #contactus input[type="tel"]:hover,
        #contactus input[type="url"]:hover,
        #contactus textarea:hover {
            -webkit-transition: border-color 0.3s ease-in-out;
            -moz-transition: border-color 0.3s ease-in-out;
            transition: border-color 0.3s ease-in-out;
            border: 1px solid #aaa
        }

        #contactus textarea {
            height: 100px;
            max-width: 100%;
            resize: none
        }

        #contactus button[type="submit"] {
            cursor: pointer;
            width: 100%;
            border: none;
            background: #f0715f;
            color: #FFF;
            margin: 0 0 5px;
            padding: 10px;
            font-size: 15px
        }

        #contactus button[type="submit"]:hover {
            background: #f07150;
            -webkit-transition: background 0.3s ease-in-out;
            -moz-transition: background 0.3s ease-in-out;
            transition: background-color 0.3s ease-in-out
        }

        #contactus button[type="submit"]:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5)
        }

        #contactus input:focus,
        #contactus textarea:focus {
            outline: 0;
            border: 1px solid #aaa
        }

        ::-webkit-input-placeholder {
            color: #888
        }

        :-moz-placeholder {
            color: #888
        }

        ::-moz-placeholder {
            color: #888
        }

        :-ms-input-placeholder {
            color: #888
        }
    </style>
    <style>
        .text-left {
        text-align: left;
        }
        .text-right {
        text-align: right;
        }
        .text-center {
        text-align: center;
        }
        .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
        }

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
    </style>

</head>
<body>
    <div class="container">
    <div class="text-right text-light col-md-12">
        <br>
        <div class="btn-group">
            <button class="btn btn-sm btn-info" onclick="history.go(-1);">Back </i> </button>
            <a class="btn btn-sm btn-success" onClick="window.print()"> Print Payments Report <i class="fas fa-print"></i> </a>
        </div>
    </div>

    <div class="container"  id="print_it">
 
        <form id="contactus" action="" method="post" >
            <!-- Get School school info -->
            <div class="text-center">
                <?php 
                    $q_school ="SELECT name,address,email,phone,logo from school_info";

                    $res_school = mysqli_query($db, $q_school) or die(mysqli_error($db));
                    $count = 1;
                    if (mysqli_num_rows($res_school) > 0){  
                        $images_dir = "../../utils/images/school_info/";
                          
                        while($row_school = mysqli_fetch_array($res_school)){ 
                            $picname = $row_school['logo']; 
                            echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='240' height='150'> ";
                            echo "<h3>".$row_school['name']."</h3> ";
                            echo "<h4>".$row_school['address']."</h4>";
                            echo "<h4>Email: ".$row_school['email']."</h4>";
                            echo "<h4>Mobile: ".$row_school['phone']."</h4>";
                        }
                    } 
                
                ?>
            </div>
            <!-- Get Students Personal info.... and parents later in the same row. -->
            <div class="row">
                <div class="col-md-5 text-right">
                        <h3 style="color:lightblue"> Students Info</h3>
                    <?php 
                        $q_stud ="SELECT name,class_id, address,email,phone,parentid FROM students WHERE id = '$student_id' ";

                        $res_stud = mysqli_query($db, $q_stud) or die(mysqli_error($db));
                        $count = 1;
                        if (mysqli_num_rows($res_stud) > 0){  
                            while($row_stu = mysqli_fetch_array($res_stud)){
                                $parentid = $row_stu['parentid'];
                                echo "<h3>Name: ".$row_stu['name']."</h3> ";
                                    $class_id = $row_stu['class_id'];
                                    $class_id_q = "SELECT name FROM classes WHERE id = '$class_id' ";
                                    $class_id_res = mysqli_query($db,$class_id_q);
                                    $class_id_row = mysqli_fetch_array($class_id_res);
                                echo "<h4>Class: ".$class_id_row['name']."</h4>";
                                echo "<h4>Address: ".$row_stu['address']."</h4>";
                                echo "<h4>Email: ".$row_stu['email']."</h4>";
                                echo "<h4>Mobile: ".$row_stu['phone']."</h4>";

                                
                            }
                        } 
                    ?>
                </div>
                <hr class="" style="background-color:red">
                <div class="col-md-6 col-lg-6">
                        <h3 style="color:lightblue"> Parents Info</h3>
                    <?php 
                        global $parentid;
                        $q_parent ="SELECT * FROM parents WHERE id = '$parentid' ";

                        $res_parent = mysqli_query($db, $q_parent) or die(mysqli_error($db));
                        $count = 1;
                        if (mysqli_num_rows($res_parent) > 0){                              
                            while($row_parent = mysqli_fetch_array($res_parent)){ 
                                echo "<h3>Mother: ".$row_parent['mothername']."</h3> ";
                                echo "<h4>Mothers Phone: ".$row_parent['motherphone']."</h4> ";
                                echo "<h3>Father: ".$row_parent['fathername']."</h3>";
                                echo "<h4>Fathers Mobile: ".$row_parent['fatherphone']."</h4  > ";
                                echo "<h4>Address: ".$row_parent['address']."</h4>";

                            }
                        } 
                    
                    ?>
                </div>
            </div>
            </br>
            <!-- Get Results -->
            <div class="text-center text-info"><h2> Students Tuition Payments Report </h2></div>
            <br><br>


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
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="4">
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
                                                AND term = '$term' ORDER BY `fees`.`date_paid` ASC " )or die("An error occured: ".mysqli_error($db));
                                            if(mysqli_num_rows($term_fee_history_query) >= 1){
                                            while($term_fee_history_row  = mysqli_fetch_assoc($term_fee_history_query) ){
                                                $amount_paid = $term_fee_history_row['amount'];
                                                $method = $term_fee_history_row['method'];
                                                $date_paid_raw = strtotime($term_fee_history_row['date_paid']);
                                                $date_paid = date('d F, Y',$date_paid_raw);
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
                                            echo "<td>".$get_bank_row['name']."</td>"; /** Method if paid Bank - Row 3 */
                                            }elseif($method == 'Cash'){
                                            $acc = $term_fee_history_row['recieved_by'];
                                            $get_bank_query = mysqli_query($db, "SELECT * FROM accountants WHERE id = '$acc' LIMIT 1 ");
                                            $get_bank_row = mysqli_fetch_assoc($get_bank_query);
                                            echo "<td>".$get_bank_row['name']."</td>"; /** Method if paid by cash - Row 3 */
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
                                        <th>Total Paid</th>
                                        <th><?php echo "$currency ".number_format($total,2); ?></th>
                                        <th>Balance </th>
                                        <th> <?php $outstanding_balance = $total_term_fees - $total;
                                                  echo "$currency ".number_format($outstanding_balance,2);   ?> </th>
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





        </form>
    </div>

    </div>
</body>
</html>