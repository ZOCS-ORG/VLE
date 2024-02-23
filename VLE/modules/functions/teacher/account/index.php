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


  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <?php

      $query = "SELECT  count(1) from classes where teacher_id = '$id' ";

      if (mysqli_query($db, $query)) {
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
      }
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $total = $row[0];
      ?>

        <div class="col-xl-4 col-md-4 mb-3">
          <div class="card border-left-success shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-dark text-uppercase mb-1"> My Classes </div>
                  <div class="text-right h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?> </div>
                </div>
                <div class="col-auto">

                </div>
              </div>
            </div>
            <hr>
            <div class="text-right col-auto">
              <a class="btn-block btn btn-sm btn-success" href="../classes/index.php">View</a>
            </div>
          </div>
        </div>

      <?php  } ?>

      <?php

      $query = "SELECT  count(1) FROM subjects 
                          INNER JOIN teacher_subject_class
                          ON subjects.id = teacher_subject_class.subject_id
                          WHERE teacher_id = '$id' ";

      if (mysqli_query($db, $query)) {

        echo "";
      } else {

        echo "Error: " . $query . "<br>" . mysqli_error($db);
      }

      $result = mysqli_query($db, $query);

      if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);
        $total = $row[0];
      ?>
        <div class="col-xl-4 col-md-6 mb-3">
          <div class="card border-left-success shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-success text-uppercase mb-1">My Subjects</div>
                  <div class="text-right h5 mb-0 font-weight-bold text-success"><?php echo $total; ?></div>
                </div>
                <div class="col-auto">

                </div>
              </div>
            </div>
            <hr>
            <div class="text-right col-auto">
              <a class="btn-block btn btn-sm btn-success" href="../subjects/index.php">View</a>
            </div>
          </div>
        </div>
      <?php } ?>


      <div class="col-xl-4 col-md-4 mb-3">
        <div class="card border-left-success shadow py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-sm font-weight-bold text-dark text-uppercase mb-1"> VLE-Learning </div>
                <div class="text-right h5 mb-0 font-weight-bold text-white"> . </div>
              </div>
              <div class="col-auto">

              </div>
            </div>
          </div>
          <hr>
          <div class="text-right col-auto">
            <form id="loginForm" class="" action="../../../../lms/teacher" method="post">
              <input type="hidden" name="username" value="<?php echo $s_user; ?>">
              <input type="hidden" name="password" value="<?php echo $s_pass; ?>">
              <input type="submit" class="btn-block btn btn-sm btn-success" value="View" style="">
            </form>
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
      <h5 class="h5 mb-0 text-success ">Notice Board </h5>
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
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>