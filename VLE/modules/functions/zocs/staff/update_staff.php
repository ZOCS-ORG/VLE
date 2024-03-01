<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$staff_id = $_GET['id'];

?>
<hr />
<?php
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
                                    <td>Name:</td>
                                    <td class="text-right"><input class="form-control" id="name" type="text" name="name" placeholder="<?php echo $row['name'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Username:</td>
                                    <td class="text-right"><input class="form-control" type="text" name="username" placeholder="<?php echo $row['username'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Position:</td>
                                    <td class="text-right"><input class="form-control" type="text" name="position" placeholder="<?php echo $row['position'] ?>"></td>
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
                                <tr id="provinceRow">
                                    <td>Province:</td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            <select id="provinceSelect" name="province" class="form-control">
                                                <option value="0">-- Select Province --</option>
                                                <?php
                                                $query = mysqli_query($db, "SELECT * FROM provinces") or die(mysqli_error($db));
                                                while ($provinceRow = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $provinceRow['province_id']; ?>" <?php echo ($provinceRow['province_id'] == $row['province_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $provinceRow['province_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                                if ($row['district_id'] != 0) {
                                ?>
                                    <tr id="districtRow">
                                        <td>District:</td>
                                        <td class="text-right">
                                            <div class="form-group">
                                                <select id="districtSelect" name="district" class="form-control">
                                                    <option value="0">-- Select District --</option>
                                                    <?php
                                                    $districtQuery = mysqli_query($db, "SELECT * FROM districts") or die(mysqli_error($db));
                                                    while ($districtRow = mysqli_fetch_array($districtQuery)) {
                                                    ?>
                                                        <option value="<?php echo $districtRow['district_id']; ?>" <?php echo ($districtRow['district_id'] == $row['district_id']) ? 'selected' : ''; ?>>
                                                            <?php echo $districtRow['district_name']; ?>
                                                        </option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>


                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input class="form-control" id="address" type="text" name="address" placeholder="<?php echo $row['address'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Picture:</td>
                                    <td class="text-right">
                                        <input class="form-control" id="file" type='file' name='file'>
                                        <?php if (!empty($row['img'])) { ?>
                                            <img src="../../../utils/images/users/<?php echo $row['img']; ?>" alt="Current Picture" width="150">
                                        <?php } ?>
                                    </td>
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#provinceSelect').change(function() {
                    var provinceId = $(this).val();
                    // console.log(provinceId);
                    if (provinceId !== 'none') {
                        $.ajax({
                            url: 'get_district.php',
                            type: 'POST',
                            data: {
                                province_id: provinceId
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                $('#districtSelect').empty();
                                $('#districtRow').show();
                                $('#districtSelect').append($('<option>', {
                                    value: 'none',
                                    text: '-- Select District --'
                                }));
                                $.each(response, function(key, value) {
                                    $('#districtSelect').append($('<option>', {
                                        value: value.district_id,
                                        text: value.district_name
                                    }));
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        $('#districtRow').hide();
                        $('#districtSelect').empty();
                    }
                });
            });
        </script>



<?php
    }
} else {
    echo 'No Records Found!';
}
?>



<?php

require_once('../layouts/footer_to_end.php');

?>