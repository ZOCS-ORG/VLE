<?php 
    require_once('../../../config/admin_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $grade_id = $_GET['id'];
?>

<style>
    .table-width {
    padding-right: 75px;
    padding-left: 75px;
    margin-right: auto;
    margin-left: auto;
    }
    @media (min-width: 768px) {
    .table-width {
        width: 750px;
    }
    }
    @media (min-width: 992px) {
    .table-width {
        width: 970px;
    }
    }
    @media (min-width: 1200px) {
    .table-width {
        width: 1170px;
    }
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

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" value="<?php echo $grade_id; ?>" name="id">
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input id="name" type="text" name="name" placeholder="<?php echo $row['name']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Minimum percentage:</td>
                                    <td class="text-right"><input id="name" type="text" name="min" placeholder="<?php echo $row['min_value']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Maxmum percentage:</td>
                                    <td class="text-right"><input id="name" type="text" name="max" placeholder="<?php echo $row['max_value']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_grade"value="Submit"></td>
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

<?php require_once('../layouts/footer_to_end.php'); ?>

