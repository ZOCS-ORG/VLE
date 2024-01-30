<?php
    session_start();
    include('../../utils/vars.php');
    require_once('../../config/config.php');

    $id = $_SESSION['id'];
    
    $student_id = $_GET['stud_id'];

    $results_name = $_GET['name'];

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Results Report Card</title>
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
            <a class="btn btn-sm btn-success" onClick="window.print()">Print Report Card <i class="fas fa-print"></i> </a>
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
            <!-- Get Students Personal info -->
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
            <div class="text-center text-info"><h2> Students Grade Report For <?php echo $results_name ?> </h2></div>
            <br><br>
            <div class="table-responsive print-conten">
                <table class="table table-bordered table-striped" id="export" width="100%" cellspacing="4">
                    <thead>
                        <tr>
                            <!-- <th>Subject</th> -->
                            <th>Subject</th>
                            <th>Percentage</th>
                            <th>Grade</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                $query = "SELECT * FROM results WHERE name = '$results_name' AND student_id = '$student_id' ";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($result) > 0){                   
                                    while($row = mysqli_fetch_assoc($result)){        

                                    /** Get All Subjects by studdent -row 1- */
                                    $subject_id = $row['subject_id'];
                                    $q = "SELECT name
                                            FROM subjects
                                            WHERE id = '$subject_id' ";
                                    $res = mysqli_query($db, $q) or die(mysqli_error($db));
                                    if (mysqli_num_rows($res) > 0){
                                        while($r = mysqli_fetch_assoc($res)){ 
                                            echo "<td>".$r['name']."</td>";                                        
                                        }
                                    }
                                    // Marks/Percentage - row 2
                                    echo "<th>".$row['marks']."</th>";
                                    // Grade - row 3

                                    $value = $row['marks'];
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
                                    // Comments - row 4
                                    echo "<th>".$row['comment']."</th>";
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

        </form>
    </div>

    </div>
</body>
</html>