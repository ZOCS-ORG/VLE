<?php
error_reporting(0);
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
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-4 col-md-4 mb-3">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-dark text-uppercase mb-1"> Our Kids </div>
                                <div class="text-right h5 mb-0 font-weight-bold text-gray-800"> </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right col-auto">
                        <a class="btn-block btn btn-sm btn-success" href="../students/index.php">View</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-3">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-dark text-uppercase mb-1">Message  </div>
                                <div class="text-right h5 mb-0 font-weight-bold text-gray-800"> </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right col-auto">
                        <a class="btn-block btn btn-sm btn-success" href="../chat">Teacher</a>
                    </div>
                </div>
            </div>
          
            <div class="col-xl-4 col-md-4 mb-3">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php

                                function limitTxt($str, $max, $print)
                                {
                                    if (strlen($str) > $max) {
                                        $str = substr($str, 0, $print) . '...';
                                    }
                                    return $str;
                                }

                                $q = mysqli_query($db, "SELECT * FROM blogs ORDER BY id DESC LIMIT 1") or die("Connection error: " . mysqli_error($db));

                                $r = mysqli_fetch_array($q);
                                ?>
                                <div class="text-sm font-weight-bold text-dark text-uppercase mb-1">Latest Blog:
                                    <span style="font-size:20px">"</span><small><?php echo limitTxt($r['title'], 40, 40); ?></small><span style="font-size:20px">"</span>
                                </div>
                                <small class="text-right  mb-0 font-weight-bold text-gray-800"> </small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right col-auto">
                        <a class="btn-block btn btn-sm btn-success" href="../../../../../blogs.php" target="_blank">View All Blogs</a>
                    </div>
                </div>
            </div>

        </div>

        <hr>

        <!-- Feeds Heading -->
        <div class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5 border-success">
            <h5 class="h5 mb-0 text-success ">Announcements </h5>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->

            <div class="col-lg-6 mb-4">

                <?php
                $query = "SELECT  * from announcements WHERE audience = '$role' OR  audience = 'All' ORDER BY id DESC ";

                if (mysqli_query($db, $query)) {

                    echo "";
                } else {

                    echo "Error: " . $query . "<br>" . mysqli_error($db);
                }

                $count = 1;

                $result = mysqli_query($db, $query);

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['title']; ?></h6>
                            </div>
                            <div class="card-body">
                                <p> <?php echo $row['name']; ?> </p>
                                <a href="view_announcements.php?id=<?php echo $row['id'] ?>">View</a>
                            </div>
                        </div>

                        <?php
                        $count++;
                    }
                } else {
                    echo 'Announcements from the Adminstration will apear here.';
                }
                ?>

            </div>

            <div class="col-lg-6 mb-4">
                <?php
                $query = "SELECT classes.name AS class_name,notices.title,notices.date,notices.id AS id, students.id AS student_id FROM notices 
                  INNER JOIN classes ON classes.id = notices.class
                  INNER JOIN students ON students.class_id = classes.id
                  WHERE students.parentid = '$id'
                  GROUP BY title
                  ORDER BY id DESC LIMIT 5";

                $result = mysqli_query($db, $query) or die(mysqli_error($db));

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $notice_id = $row['id'];
                        $title = $row['title'];
                        $class_name = $row['class_name'];
                        $student_id = $row['student_id'];
                        $date = $row['date'];
                        // echo $id
                        ?>

                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                            </div>
                            <div class="card-body">
                                <p>Class: <?php echo $class_name; ?> </p>
                                <p>Date Posted: <?php echo $date; ?> </p>
                                <a target="_blank" rel="nofollow" href="../../../../lms/student/stud_profile.php?student_id=<?php echo $student_id ?>#assgs">View</a>
                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo 'Announcements from the teachers will apear here.';
                }
                ?>

            </div>


        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>