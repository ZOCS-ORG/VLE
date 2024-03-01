<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$staff_id = $_GET['id'];

?>
<hr />
<?php
$query2 = "SELECT  * FROM school_teachers WHERE teacher_id = '$staff_id' ";

$result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
$row2 = mysqli_fetch_assoc($result2);

$query = "SELECT  * FROM users WHERE id = '$staff_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update Staff Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="update_staff.php" method="POST" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <tr>
                                    <!-- <td class="text-left">Id:</td> -->
                                    <td class="text-right"><input class="form-control" id="id" type="hidden" name="id" value="<?php echo $row['id'] ?>" placeholder="<?php echo $row['id'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <!-- <td class="text-left">Id:</td> -->
                                    <td class="text-right"><input class="form-control" id="cb" type="hidden" name="cb" value="<?php echo $staff_id ?>" placeholder="<?php echo $row['created_by'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input class="form-control" id="name" type="text" name="name" placeholder="<?php echo $row['name'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Username:</td>
                                    <td class="text-right"><input class="form-control" type="text" name="username" placeholder="<?php echo $row['username'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password:</td>
                                    <td class="text-right"><input class="form-control" id="password" type="password" name="password" placeholder="New password"></td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="text-right"><input class="form-control" id="phone" type="text" name="phone" placeholder="<?php echo $row['phone'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="text-right"><input class="form-control" id="email" type="email" name="email" placeholder="<?php echo $row['email'] ?>"></td>
                                </tr>

                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input  class="form-control" id="address" type="text" name="address" placeholder="<?php echo $row['address'] ?>"></td>
                                </tr>
                                <tr>
                                    <td style="color: black"><b>PTA:</b></td>
                                    <td class="text-right">
                                        <input type="radio" name="pta" id="ptaTrue" value="true" onclick="teapta = this.value;">
                                        <label for="ptaTrue">True</label>
                                        <input type="radio" name="pta" id="ptaFalse" value="false" onclick="teapta = this.value;">
                                        <label for="ptaFalse">False</label>
                                    </td>
                                </tr>
                                <tr>
                                <td style="color: black"><b>School:</b></td>
                                <td class="text-right">
                                    <div class="form-group">
                                        <select name="school" class="form-control" id="school" required>
                                            <option value="">-- SELECT --</option>
                                            <?php
                                            $sql = "SELECT * FROM schools;";
                                            $res = mysqli_query($db, $sql) or die('An error occurred: ' . mysqli_error($db));
                            
                                            while ($row = mysqli_fetch_array($res)) {
                                                $selected = ($row['school_id'] == $row2['school_id']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $row['school_id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            
                            

                                <tr>
                                    <td>Picture:</td>
                                    <td class="text-right"><input id="file" type='file' name='file'></td>
                                </tr>


                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-secondary " type="submit" name="update_staff" value="Submit"></td>
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