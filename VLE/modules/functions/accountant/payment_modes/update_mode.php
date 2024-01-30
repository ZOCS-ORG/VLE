<?php
    require_once('../../../config/accounts_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $mode_id = $_GET['id'];
?>
  <!-- Main Content -->
  <div id="content">

<br>
      <!-- Begin Page Content -->
      <div class="container-fluid">

            <!-- Add Bank Modal -->
              <div class="col-md-12">

                    <div class="card-header mx-auto col-md-6"><h5 class="text-center my-2">Update Mode of Payment</h5></div>
                    <div class="card-body mx-auto col-md-6">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <?php 
                                $get_bank_query = mysqli_query($db, "SELECT * FROM payment_modes WHERE id = $mode_id" );
                                while($row = mysqli_fetch_assoc($get_bank_query)){
                                    
                            ?>

                            <table class="table" id="dataTable" width="70%" cellspacing="9">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input type="text" name="name" placeholder="<?php echo $row['name'] ?>" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_mode"value="Submit"></td>
                                </tr>
                            </table>
                                <?php } ?>
                        </form>
                    </div>

                </div>
            <!-- Add Bank Modal Ends -->


      </div>
      <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->
<?php require_once('../layouts/footer_to_end.php'); ?>