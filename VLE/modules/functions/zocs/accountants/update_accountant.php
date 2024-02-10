<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $accountant_id = $_GET['id'];

?>

        <hr/>     
        
        <?php 
            $query = "SELECT  * from accountants where id = '$accountant_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update Accountant's Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="update_accountant.php" method="POST" enctype="multipart/form-data">

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
                                    <td>Username:</td>
                                    <td class="text-right"><input id="name" type="text" name="username" placeholder="<?php echo $row['username']?>"></td>
                                </tr>
                                <tr>
                                    <td>Password:</td>
                                    <td class="text-right"><input id="password" type="password" name="password" placeholder="New password"></td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="text-right"><input id="phone"type="text" name="phone" placeholder="<?php echo $row['phone']?>"></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="text-right"><input id="email"type="email" name="email" placeholder="<?php echo $row['email']?>"></td>
                                </tr>
                                <tr>
                                    <td>Salary:</td>
                                    <td class="text-right"><input id="salary" type="number" name="salary" placeholder="<?php echo $row['salary']?>"></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input id="address" type="text" name="address" placeholder="<?php echo $row['address']?>"></td>
                                </tr>
                                <tr>
                                    <td>Picture:</td>
                                    <td class="text-right"><input id="file" type='file' name='file' ></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-secondary " type="submit" name="update_accountant" value="Submit"></td>
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
