<?php 
    require_once('../../../config/admin_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];
?>

<style>
    .table-width {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
</style>

<?php 
    $query = "SELECT * from subjects where id = '$id' ";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0){                   
        while($row = mysqli_fetch_assoc($result)){ 
?>

<div class="container table-width">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">
                <div class="card-header"><h5 class="text-center my-2">Update Programs </h5></div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name:</label>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input class="btn btn-sm btn-primary" type="submit" name="update_subject" value="Submit">
                            </div>
                        </div>
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

<?php require_once('../layouts/footer_to_end.php'); ?>
