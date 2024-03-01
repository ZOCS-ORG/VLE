<?php
    session_start();
    include('../../utils/vars.php');
    require_once('../../config/config.php');

    $id = $_SESSION['id'];
    
    $payment_id = $_GET['payment_id'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Payment Receipt</title>
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
            <button class="btn btn-sm btn-info" onclick="location.href='../accountant/payments/index.php';">Back </i> </button>
            <a class="btn btn-sm btn-success" onClick="window.print()"> Print Payment Receipt <i class="fas fa-print"></i> </a>
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

            </br>
            <!-- Get Results -->
            <div class="text-center text-info"><h2> Payments Reciept </h2></div>
            <br><br>


            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-10 mx-auto mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-uppercase text-justify"><?php 
                            $payments_query = mysqli_query($db, "SELECT * 
                                FROM payments WHERE id = '$payment_id' " )
                                or die("An error occured: ".mysqli_error($db));
                            if(mysqli_num_rows($payments_query) >= 1){
                            while($payments_row  = mysqli_fetch_assoc($payments_query) ){
                                $payer = $payments_row['paid_by'];
                                $desc = $payments_row['description'];
                                $amount_paid = $payments_row['amount'];
                                $method = $payments_row['method'];
                                $date_paid_raw = strtotime($payments_row['date_paid']);
                                $date_paid = date('d F, Y',$date_paid_raw);

                                /** Set payment vars */
                                if($payments_row['method'] == "Cash"){
                                    $acc = $payments_row['recieved_by'];
                                    $reciever_query = mysqli_query($db, "SELECT name 
                                        FROM accountants WHERE id = '$acc' " )
                                        or die("An error occured: ".mysqli_error($db));
                                    if(mysqli_num_rows($reciever_query) >= 1){
                                    while($reciever_row  = mysqli_fetch_assoc($reciever_query) ){
                                        $reciever = $reciever_row['name'];
                                        $payment_method = " in cash recieved by $reciever ";
                                    } }
                                }elseif($payments_row['method'] == "Bank"){
                                    $bank = $payments_row['bank_acc'];
                                    $reciever_query = mysqli_query($db, "SELECT name, account_name 
                                        FROM banks WHERE id = '$bank' " )
                                        or die("An error occured: ".mysqli_error($db));
                                    if(mysqli_num_rows($reciever_query) >= 1){
                                    while($reciever_row  = mysqli_fetch_assoc($reciever_query) ){
                                        $bank_name = $reciever_row['name'];
                                        $bank_acc = $reciever_row['account_name'];
                                        $payment_method = " via a bank deposite to $bank_acc $bank_name ";
                                    } }
                                }else{ $payment_method = " via ".$payments_row['method']; }

                                echo "<p> <b>$payer </b> has on <b> $date_paid </b> paid the sum of <b> $currency ". number_format($amount_paid, 2) ." </b><b> $payment_method </b>
                                        for <b> $desc </b> </p>";


                            }}
                                
                                
                                 
                            
                            
                            
                                ?>                            
                            </h6>
                        </div>


                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->





        </form>
    </div>

    </div>
</body>
</html>