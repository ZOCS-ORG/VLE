<?php 
    require_once('../../../config/admin_server.php');
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

                    <div class="card-header"><h5 class="text-center my-2"> Assign Subjects </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" name="id">
                                <tr>
                                    <td>Teacher:</td>
                                    <td class="text-right">
                                        <select name="teacher" id="teacher">
                                            <?php
                                            $res = mysqli_query($db, "SELECT * FROM teachers");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']." - ID : ".$row['id']; ?> </option>
                                        <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subject:</td>
                                    <td class="text-right">
                                        <select name="subject" id="student">
                                            <?php
                                            $res = mysqli_query($db, "SELECT * FROM subjects");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                        <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Class(es) to teach:</td>
                                    <td class="text-right">
                                        <select name="classes[]" multiple="multiple" id="subj">
                                            <?php
                                            $res = mysqli_query($db, "SELECT * FROM classes");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                            <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="assign_subject"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Multi-Select suport -->
<link rel="stylesheet" href="../layouts/vannilaSelect/vanillaSelectBox.css">

<script src="../layouts/vannilaSelect/vanillaSelectBox.js"></script>
<script>

  let mySelect = new vanillaSelectBox("#subj",{
      maxWidth: 500,
      maxHeight: 400,
      minWidth: -1,
      search: true,
      placeHolder: 'Classes to teach. ' 
  });

</script>
<!-- End multi-select support  -->


<?php require_once('../layouts/footer_to_end.php'); ?>

