<?php 
    //require_once('../scripts/parent_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good on that🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $parent_id = $_GET['id'];

?>

        <hr/>     
        
        <?php 
            $query = "SELECT  * from parents where id = '$parent_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update Parent's Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="update_parent.php" method="POST" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <tr>
                                    <td class="text-left">Parent Id:</td>
                                    <td class="text-right"><input id="id"type="text" name="id" value="<?php echo $row['id']?>" placeholder="<?php echo $row['id']?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Username:</td>
                                    <td class="text-right"><input type="text" name="username" placeholder="<?php echo $row['username']?>"></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="text-right"><input type="email" name="email" placeholder="<?php echo $row['email']?>"></td>
                                </tr>
                                <tr>
                                    <td>Mother's Name:</td>
                                    <td class="text-right"><input type="text" name="mothername" placeholder="<?php echo $row['mothername']?>"></td>
                                </tr>
                                <tr>
                                    <td>Father's Name:</td>
                                    <td class="text-right"><input type="text" name="fathername" placeholder="<?php echo $row['fathername']?>"></td>
                                </tr>
                                <tr>
                                    <td>Password:</td>
                                    <td class="text-right"><input type="text" name="password" placeholder="New Password"></td>
                                </tr>
                                <tr>
                                    <td>Mother's Number:</td>
                                    <td class="text-right"><input type="text" name="motherphone" placeholder="<?php echo $row['motherphone']?>"></td>
                                </tr>
                                <tr>
                                    <td>Father's Number:</td>
                                    <td class="text-right"><input type="text" name="fatherphone" placeholder="<?php echo $row['fatherphone']?>"></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input type="text" name="address" placeholder="<?php echo $row['address']?>"></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-secondary " type="submit" name="update_parent" value="Submit"></td>
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
