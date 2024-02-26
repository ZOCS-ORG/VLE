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
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-s border-0 rounded-lg mt-1">

                    <div class="card-header"><h5 class="text-center my-2">Update Announcement </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <tr>
                                    <td>Type:</td>
                                    <td class="text-right"><input type="text" name="title" placeholder="<?php echo $row['title']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Announcement:</td>
                                    <td class="text-right"><textarea type="text" name="name" placeholder="<?php echo $row['name']; ?>" ></textarea></td>
                                </tr>
                                <tr>
                                    <td>Audience</td>
                                    <td  class="text-right">
                                        <select name="audience" id="testSelect1" class="select_style" required>
                                            <option></option>
                                            <option value="All">All</option>
                                            <?php
                                            $res = mysqli_query($db, "SELECT user_role FROM users GROUP BY user_role ");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['user_role'];?>"> <?php echo $row['user_role']; ?> </option>
                                            <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td class="text-right">
                                    <input type="text" name="date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                                readonly placeholder="<?php echo $row['date']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td> <input type="hidden" name="id" value="<?php echo $row['id'] ?>"> </td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_announcement" value="Submit"></td>
                                </tr>
                            </table>
                            <input type="hidden" value="<?php echo $anno_id; ?>" name="id" />
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

