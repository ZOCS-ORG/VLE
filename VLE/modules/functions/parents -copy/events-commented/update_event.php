<?php 
    require_once('../../../config/teacher_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $event_id = $_GET['id'];
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
            $query = "SELECT * from calendar where id = '$event_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-s border-0 rounded-lg mt-1">

                    <div class="card-header"><h5 class="text-center my-2">Update Event </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
                                <tr>
                                    <td>Type:</td>
                                    <td class="text-right"><input type="text" name="type" placeholder="<?php echo $row['type']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input type="text" name="name" placeholder="<?php echo $row['name']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td class="text-right"><input type="text" name="description" placeholder="<?php echo $row['description']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Start Date:</td>
                                    <td class="text-right">
                                    <input type="text" name="start_date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                                readonly placeholder="Start date">
                                    </td>
                                </tr>
                                <tr>
                                    <td>End Date:</td>
                                    <td class="text-right">
                                    <input type="text" name="end_date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                                readonly placeholder="End date">
                                    </td>
                                </tr>
                                <tr>
                                    <td> <input type="hidden" name="id" value="<?php echo $row['id'] ?>"> </td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_event" value="Submit"></td>
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

