<?php 
    require_once('../../../config/admin_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $grade_id = $_GET['id'];
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
    $query = "SELECT * from grades where id = '$grade_id' ";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0){                   
        while($row = mysqli_fetch_assoc($result)){ 
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header"><h5 class="text-center my-2">Update Grade </h5></div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name:</label>
                            <div class="col-sm-8">
                                <input id="name" type="text" name="name" class="form-control" placeholder="<?php echo $row['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="min" class="col-sm-4 col-form-label">Minimum percentage:</label>
                            <div class="col-sm-8">
                                <input id="min" type="text" name="min" class="form-control" placeholder="<?php echo $row['min_value']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="max" class="col-sm-4 col-form-label">Maximum percentage:</label>
                            <div class="col-sm-8">
                                <input id="max" type="text" name="max" class="form-control" placeholder="<?php echo $row['max_value']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <button class="btn btn-sm btn-primary" type="submit" name="update_grade">Submit</button>
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
