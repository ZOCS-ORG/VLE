<?php
require_once('../../../config/teacher_server.php');
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

    input{
        width: 70%;
        border-radius: 9px;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8" style="border: 1px solid #73AD21; ">

            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Create Class </h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <input id="id" type="hidden" value="<?php echo $_SESSION['id']; ?>" name="id">
                            <tr>
                                <td>Class Name:</td>
                                <td class="text-right"><input id="name" type="text" name="name" placeholder="Class Name"></td>
                            </tr>
                            <!-- <tr>
                                <td>Room No.:</td>
                                <td class="text-right"><input id="room" type="text" name="room" placeholder="Room No."></td>
                            </tr> -->
                            <!-- <tr>
                                <td>Class Monitor:</td>
                                <td class="text-right">
                                    <select name="monitor" id="student" class="select2" style="padding:4px; width:70%; border-radius:9px" >
                                        <option value=""></option>
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM students");
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name'] . " of ID '" . $row['id'] . "'"; ?> </option>
                                        <?php   }     ?>
                                    </select>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td>Select Learners:</td>
                                <td class="text-right">
                                    <select name="students[]" multiple="multiple" id="subj" style="padding:4px; width:70%; border-radius:9px" >
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM students");
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                        <?php   }     ?>
                                    </select>
                                </td>
                            </tr> -->
                            <tr>
                                <td></td>
                                <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_class" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Multi-Select suport -->
<link rel="stylesheet" href="./vanillaSelectBox.css">

<script src="./vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#subj", {
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,

    });
</script>
<!-- End multi-select support  -->


<?php //include_once('layouts/footer_to_end.php'); ?>