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
    <div class="container-fluid">
        <!-- Feeds Heading -->
          <div style="background-color: green" class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5" >
            <h5 class="h5 mb-0 text-info ">Notice Board </h5>
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
                    echo ' <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Nothing to show</h6>
                            </div>
                            <div class="card-body">
                                <p> There are currently no announcements on the notice board. </p>
                               
                            </div>
                        </div>';
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