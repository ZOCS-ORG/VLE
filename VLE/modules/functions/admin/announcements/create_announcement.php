<?php 
    require_once('../../../config/manager_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header"><h5 class="text-center my-2">Create Announcement</h5></div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">Title:</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="announcement" class="col-sm-4 col-form-label">Announcement:</label>
                            <div class="col-sm-8">
                                <textarea name="announcement" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="audience" class="col-sm-4 col-form-label">Audience:</label>
                            <div class="col-sm-8">
                                <select name="audience" id="audience" class="form-control">
                                    <option value="All">All</option>
                                    <?php
                                    $res = mysqli_query($db, "SELECT user_role FROM users GROUP BY user_role ");
                                    while($row = mysqli_fetch_array($res)) {
                                        echo '<option value="'.$row['user_role'].'">'.$row['user_role'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label">Date:</label>
                            <div class="col-sm-8">
                                <input type="text" name="date" id="date" class="form-control" placeholder="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <input type="hidden" name="created_by" value="<?php echo $id ?>">
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <input class="btn btn-sm btn-primary" type="submit" name="create_announcement" value="Submit">
                            </div>
                        </div>
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

<?php require_once('../layouts/footer_to_end.php'); ?>
