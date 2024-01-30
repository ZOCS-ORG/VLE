<?php 
    require_once('../../../config/accounts_server.php');
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

                    <div class="card-header"><h5 class="text-center my-2">Add Tuition Payment </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <tr>
                                    <td>Student Name:</td>
                                    <td class="text-right">
                                        <select name="student_id" id="subj" required>
                                            <?php
                                            $res = mysqli_query($db, "SELECT * FROM students");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']." - ".$row['id']; ?> </option>
                                            <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Amount Recieved:</td>
                                    <td class="text-right"><input type="number" name="amount" placeholder="eg 1000" required /></td>
                                </tr>
                                <tr>
                                    <td>Date Recieved:</td>
                                    <td class="text-right">
                                        <input type="text" name="date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                            readonly required />
                                    </td>
                                </tr>
                                <tr>
                                    <td>For Term:</td>
                                    <td class="text-right">
                                        <select name="term" id="term" required >
                                            <option value="1"> Term 1, <?php echo date('Y') ?> </option>
                                            <option value="2"> Term 2, <?php echo date('Y') ?> </option>
                                            <option value="3"> Term 3, <?php echo date('Y') ?> </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Method of payment:</td>
                                    <td class="text-right">
                                        <select name="method">
                                            <option readonly> </option>
                                            <?php
                                            $res = mysqli_query($db, "SELECT name,id FROM payment_modes ");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['name'];?>"> <?php echo $row['name']; ?> </option>
                                            <?php   }  ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Recieved By <small class="text-danger">For cash only</small>:</td>
                                    <td class="text-right">
                                        <select name="recieved_by" id="term">
                                            <option readonly> </option>
                                            <?php
                                            $res = mysqli_query($db, "SELECT name,id FROM accountants ");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                            <?php   }  ?>
                                        </select>
                                        </td>
                                </tr>
                                <tr>
                                    <td>If "Bank" Choose Bank account:</td>
                                    <td class="text-right">
                                        <select name="bank" id="term">
                                            <option readonly> </option>
                                            <?php
                                            $res = mysqli_query($db, "SELECT name,id FROM banks ");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                            <?php   }  ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_tuition"value="Submit"></td>
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

  let mySelect = new vanillaSelectBox("#subj",{
      maxWidth: 500,
      maxHeight: 400,
      minWidth: -1,
      search: true, 
  });

</script>
<!-- End multi-select support  -->


<?php require_once('../layouts/footer_to_end.php'); ?>

