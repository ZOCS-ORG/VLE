<?php
require_once('../../../config/manager_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$anno_id = $_GET['id'];
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
$query = "SELECT * from announcements where id = '$anno_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8"> <!-- Adjust the column width as needed -->
                    <div class="card shadow-sm border-0 rounded-lg mt-1">
                        <div class="card-header">
                            <h5 class="text-center my-2">Update Announcement</h5>
                        </div>
                        <div class="card-body">
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-4 col-form-label">Type:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="announcement" class="col-sm-4 col-form-label">Announcement:</label>
                                    <div class="col-sm-8">
                                        <textarea name="name" class="form-control" placeholder="<?php echo $row['name']; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="audience" class="col-sm-4 col-form-label">Audience:</label>
                                    <div class="col-sm-8">
                                        <select name="audience" id="testSelect1" class="form-control" required>
                                            <option value="">Select Audience</option>
                                            <option value="All">All</option>
                                            <?php
                                            $res = mysqli_query($db, "SELECT user_role FROM users GROUP BY user_role ");
                                            while ($row = mysqli_fetch_array($res)) { ?>
                                                <option value="<?php echo $row['user_role']; ?>"> <?php echo $row['user_role']; ?> </option>
                                            <?php   }     ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label">Date:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="date" id="date1" class="form-control IP_calendar" title="Y-m-d" readonly placeholder="<?php echo $row['date']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-8 offset-sm-4">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <input class="btn btn-sm btn-primary" type="submit" name="update_announcement" value="Submit">
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