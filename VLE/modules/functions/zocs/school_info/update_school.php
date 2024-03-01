<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];

?>

        <hr/>     
        
        <?php 
            $query = "SELECT  * from school_info where id = '$id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update School Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input id="name" type="text" name="name" placeholder="<?php echo $row['name']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Tagline:</td>
                                    <td class="text-right"><input id="text"type="text" name="tag" placeholder="<?php echo $row['tag']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>School Display Name: </td>
                                    <td class="text-right"><?php if(isset($dn_error)){echo "<p style='color:red'>".$dn_error."</p>";} ?> 
                                        <input type="text" name="dn" id="dn" placeholder="<?php echo $row['dn']; ?>" maxlength="10" required></td>
                                </tr>
                                <tr>
                                    <td>Contact Number:</td>
                                    <td class="text-right"><input id="phone"type="number" name="phone" placeholder="<?php echo $row['phone']; ?>r"></td>
                                </tr>
                                <tr>
                                    <td>School Email:</td>
                                    <td class="text-right"><input id="email"type="email" name="email" placeholder="<?php echo $row['email']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Established:</td>
                                    <td class="text-right">
                                    <input type="text" name="est" id="est" alt="date" class="IP_calendar" title="Y-m-d">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td class="text-right"><input type="text" id="location" name="location" placeholder="<?php echo $row['location']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input id="address" type="text" name="address" placeholder="<?php echo $row['address']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Logo:</td>
                                    <td class="text-right"><input id="file"type="file" name="file"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_school"value="Submit"></td>
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
</div>
</div>

<?php 

require_once('../layouts/footer_to_end.php'); 

?>
