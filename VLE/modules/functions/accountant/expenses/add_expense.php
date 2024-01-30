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

                    <div class="card-header"><h5 class="text-center my-2">Add Expense </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">

                                <tr>
                                    <td>Amount:</td>
                                    <td class="text-right"><input type="number" name="amount" placeholder="eg 1000" required /></td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td class="text-right">
                                        <input type="text" name="date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                            readonly required />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td class="text-right"><input type="text" name="desc" placeholder="Expense description" required/> </td>
                                </tr>
                                <tr>
                                    <td>Notes:</td>
                                    <td class="text-right"><textarea row="5" type="text" name="notes" placeholder="Notes supporting expense" ></textarea></td>
                                </tr>
                                <tr>
                                    <td>Method:</td>
                                    <td class="text-right">
                                        <select name="method">
                                            <option readonly> </option>
                                            <?php
                                            $res = mysqli_query($db, "SELECT name,id FROM payment_modes ");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                            <?php   }  ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Authorised By:</td>
                                    <td class="text-right">
                                        <?php
                                        $res = mysqli_query($db, "SELECT name,id FROM accountants ");
                                        while($row = mysqli_fetch_array($res)) { ?>
                                            <input type="text" name="paid_by" value="<?php echo $row['name'] ?>"placeholder=" <?php echo $row['name']; ?>" readonly >
                                        <?php   }  ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>From Bank account <small>optional</small>:</td>
                                    <td class="text-right">
                                        <select name="bank" >
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
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_expense"value="Submit"></td>
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

