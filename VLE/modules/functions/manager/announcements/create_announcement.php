<?php 
    require_once('../../../config/manager_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-s border-0 rounded-lg mt-1">

                    <div class="card-header"><h5 class="text-center my-2">Create Announcement </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" name="id">
                                <tr>
                                    <td>Title:</td>
                                    <td class="text-right"><input type="text" name="title" placeholder="Title"></td>
                                </tr>
                                <tr>
                                    <td>Announcement:</td>
                                    <td class="text-right"><textarea row="3" name="name" ></textarea></td>
                                </tr>
                                <tr>
                                    <td>Audience</td>
                                    <td  class="text-right">
                                        <select name="audience" id="testSelect1" class="select_style">
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
                                                readonly placeholder="<?php echo date('Y-m-d') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td> <input type="hidden" name="created_by" value="<?php echo $id ?>" >  </td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_announcement" value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
	document.multiselect('#testSelect1');
	document.multiselect('#testSelect2');
    // .setCheckBoxClick("checkboxAll", function(target, args) {
		// 	console.log("Checkbox 'Select All' was clicked and got value ", args.checked);
		// })
		// .setCheckBoxClick("1", function(target, args) {
		// 	console.log("Checkbox for item with value '1' was clicked and got value ", args.checked);
		// });

</script>
<!-- End multi-select support  -->

<?php require_once('../layouts/footer_to_end.php'); ?>

