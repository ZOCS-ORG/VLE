<?php 
    require_once('../../../config/teacher_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];
?>

<style>
    .table-width {
        width: 100%;
        max-width: 750px; /* Adjust as needed */
        margin: 0 auto;
        padding: 0 15px; /* Adjust as needed */
    }
</style>

<?php 
    $query = "SELECT * from classes where id = '$id' ";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    if (mysqli_num_rows($result) > 0){                   
        while($row = mysqli_fetch_assoc($result)){ 
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg mt-4">
                <div class="card-header"><h5 class="text-center my-2">Update Class</h5></div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <table class="table table-width">
                            <input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
                            <tr>
                                <td>Name:</td>
                                <td><input id="name" type="text" name="name" class="form-control" placeholder="<?php echo $row['name']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Room No.:</td>
                                <td><input id="room" type="text" name="room" class="form-control" placeholder="<?php echo $row['room']; ?>"></td>
                            </tr>
                            <!-- Cant update new class teacher... so removed it -->
                            <tr>
                                <td>New Class Monitor:</td>
                                <td>
                                    <select name="monitor" class="form-control">
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM students");
                                        while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center"><input class="btn btn-primary" type="submit" name="update_class" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        }
    } else {
        echo 'No Records Found!';
    }
?>

<!-- Multi-Select support -->
<link rel="stylesheet" href="vanillaSelectBox.css">
<script src="vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#subj",{
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        disableSelectAll: true,
        placeHolder: ""
    });
</script>
<!-- End multi-select support  -->

<?php require_once('../layouts/footer_to_end.php'); ?>
