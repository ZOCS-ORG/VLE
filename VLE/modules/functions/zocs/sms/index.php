<?php   

    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    require_once('../layouts/head_to_wrapper.php');

    $add_side_bar = true;
    include_once('../layouts/topbar.php');

    //   require_once('all_staff.php');

?>
      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid" style="padding:0 50px">

          <!-- Feeds Heading -->
          <div class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5 bg-dark">
            <h5 class="h5 mb-0 text-white "> SMS Manager </h5>
          </div>
          <?php require_once('../../../config/admin_sms_server.php'); ?>

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
                          function sms_balance(){
                            $balance = 'https://sms.chesco-tech.com/third-party-send-sms-merchant.php?username=test&password=user';
                            $ch = curl_init(); // initialize curl handle
                            curl_setopt($ch, CURLOPT_URL, $balance);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $result = curl_exec($ch);
                            $balance = $result;
                            echo "<span style='color:green;text-decoration:underline'>You have ".$balance." remaining messages. </span>";
                          }
                          sms_balance();
                          // echo "<br/>".$delivery_msg;
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

        <?php require_once('send_sms.php'); ?>

      </div>
      <!-- End of Main Content -->
     <?php
      require_once('../layouts/footer_to_end.php');
     ?>