<?php
//set to false if you don't want the sidebar to show
//require_once('../../../config/license/validate.php');

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

    ?>

    <!-- Feeds Heading -->
    <div class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5 bg-dark">
      <h5 class="h5 mb-0 text-white "> Sofware License </h5>
    </div>

    <!-- Content Row -->
    <div class="row">

      <div class="col-xl-7 col-md-7 mb-3 mx-auto">
        <div class="card border-info shadow py-4">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">

                <br>
                <div class="text-center h5 mb-5 text-justify font-weight-bold">
                  <?php
                  echo "<span style='color:green;text-decoration:underline'>Your License is active. </span>
                                <br/> License type: " . $type . "<br/>
                                <br/> Total users allowed: " . $users . "<br/>
                                <br/> Users registered: " . $my_users . "<br/>
                                <br/> Remaining users: " . $remaining_users . "<br/><hr>";

                  if (isset($license_msg)) {
                    echo ($license_msg);

                    if ($exp < 14) {
                      echo "Kindly renew your license to avoid incoveniences. <br/><br/>
                                            <a href='register_software.php' >Register a new licence here.</a> ";
                    }
                    echo "<br/><br/><a href='register_software.php' >Update Licence Key</a> ";
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


  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>