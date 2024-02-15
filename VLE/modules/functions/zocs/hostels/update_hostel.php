<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $hostel_id = $_GET['id'];

?>

        <hr/>     
        
        <?php 
            $query = "SELECT * from hostels where id = '$hostel_id' ";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update Teacher's Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="update_hostel.php" method="POST" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <tr>
                                    <td class="text-left">Id:</td>
                                    <td class="text-right"><input id="id"type="text" name="id" value="<?php echo $row['id']?>" placeholder="<?php echo $row['id']?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input id="name" type="text" name="name" placeholder="<?php echo $row['name']?>"></td>
                                </tr>
                                <tr>
                                    <td>Bed Capacity:</td>
                                    <td class="text-right"><input id="beds" type="number" name="beds" placeholder="<?php echo $row['beds']?>"></td>
                                </tr>
                                <tr>
                                    <td>Patreon:</td>
                                    <td class="text-right"><input id="patreon"type="text" name="patreon" placeholder="<?php echo $row['patreon']?>"></td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-secondary " type="submit" name="update_hostel" value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php
                }
            } else {
            echo 'No Records Found!';
            }
        ?>



<?php 

require_once('../layouts/footer_to_end.php'); 

?>
