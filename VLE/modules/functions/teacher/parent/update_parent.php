<?php 
    require_once('../../../config/admin_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $parent_id = $_GET['id'];
?>

<hr/>

<?php 
    $query = "SELECT * FROM users WHERE id = '$parent_id' ";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    if (mysqli_num_rows($result) > 0){                   
        while($row = mysqli_fetch_assoc($result)){ 
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update Parent's Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="update_parent.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label">Parent Id:</label>
                                <div class="col-sm-8">
                                    <input id="id" type="text" name="id" value="<?php echo $row['id']?>" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" class="form-control" placeholder="<?php echo $row['username']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" placeholder="<?php echo $row['email']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mothername" class="col-sm-4 col-form-label">Mother's Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="mothername" class="form-control" placeholder="<?php echo $row['par_mothername']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fathername" class="col-sm-4 col-form-label">Father's Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fathername" class="form-control" placeholder="<?php echo $row['par_fathername']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="password" class="form-control" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="motherphone" class="col-sm-4 col-form-label">Mother's Number:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="motherphone" class="form-control" placeholder="<?php echo $row['par_motherphone']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fatherphone" class="col-sm-4 col-form-label">Father's Number:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fatherphone" class="form-control" placeholder="<?php echo $row['par_fatherphone']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label">Address:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control" placeholder="<?php echo $row['address']?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pta" class="col-sm-4 col-form-label">PTA:</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="pta" id="ptaTrue" value="true" class="form-check-input" onclick="teapta = this.value;">
                                        <label for="ptaTrue" class="form-check-label">True</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="pta" id="ptaFalse" value="false" class="form-check-input" onclick="teapta = this.value;">
                                        <label for="ptaFalse" class="form-check-label">False</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <input class="btn btn-primary" type="submit" name="update_parent" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

<?php require_once('../layouts/footer_to_end.php'); ?>
