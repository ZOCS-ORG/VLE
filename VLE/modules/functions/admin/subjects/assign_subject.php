<?php 
    require_once('../../../config/admin_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">
                <div class="card-header"><h5 class="text-center my-2"> Assign Subjects </h5></div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="teacher" class="col-sm-3 col-form-label">Teacher:</label>
                            <div class="col-sm-9">
                                <select name="teacher" id="teacher" class="form-control">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM teachers");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                        <option value="<?php echo $row['id'];?>"> <?php echo $row['name']." - ID : ".$row['id']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subject" class="col-sm-3 col-form-label">Subject:</label>
                            <div class="col-sm-9">
                                <select name="subject" id="subject" class="form-control">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM subjects");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                        <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="classes" class="col-sm-3 col-form-label">Class(es) to teach:</label>
                            <div class="col-sm-9">
                                <select name="classes[]" multiple="multiple" id="classes" class="form-control">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM classes");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                        <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input class="btn btn-sm btn-primary" type="submit" name="assign_subject" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Multi-Select support -->
<link rel="stylesheet" href="../layouts/vannilaSelect/vanillaSelectBox.css">
<script src="../layouts/vannilaSelect/vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#classes", {
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        placeHolder: 'Classes to teach.'
    });
</script>
<!-- End multi-select support -->

<?php require_once('../layouts/footer_to_end.php'); ?>
