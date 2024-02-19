<?php 
    require_once('../../../config/teacher_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];
?>


<!-- Remove duplicates from students drop down -->
<script>
  var usedNames = {};
  $("select[name='students[]'] > option").each(function () {
      if(usedNames[this.text]) {
          $(this).remove();
      } else {
          usedNames[this.text] = this.value;
      }
  });

</script>
<!-- End duplicate remover  -->

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
            $query = "SELECT * from classes where id = '$id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-s border-0 rounded-lg mt-1">

                    <div class="card-header"><h5 class="text-center my-2">Update Class </h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input id="name" type="text" name="name" placeholder="<?php echo $row['name']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Room No.:</td>
                                    <td class="text-right"><input id="room" type="text" name="room" placeholder="<?php echo $row['room']; ?>"></td>
                                </tr>
                                <!-- Cant update new class teacher... so removed it -->
                                <tr>
                                    <td>New Class Monitor:</td>
                                    <td class="text-right">
                                        <select name="student">
                                            <?php
                                            $res = mysqli_query($db, "SELECT * FROM students");
                                            while($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                        <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Learners:</td>
                                    <td class="text-right">
                                        <select name="students[]" multiple="multiple" id="subj">
                                            <option disabled> Remove student from class </option>
                                            <?php
                                              // ALREADY SELECTED STUDENTS...
                                              $query ="SELECT students.id, students.name, class_students.id
                                                      FROM students
                                                      INNER JOIN class_students ON students.id = class_students.student_id
                                                      WHERE class_students.class_id = '$id' ";
                                              $resultss = mysqli_query($db, $query)or die('Error getting students: '. mysqli_error($db));
                                              while($row_stud = mysqli_fetch_array($resultss)){
                                                  $student_name = $row_stud['name'];
                                                  $student_id = $row_stud['0'];
                                                  //$class_stud_id = $row_stud['id'];
                                            ?>
                                              <option selected value="<?php echo $student_id;?>"> <?php echo $student_name; ?> </option>
                                            <?php  } ?>
                                              <option disabled> Add new students to class </option>
                                            <?php
                                              // REMAINING STUDENTS ...
                                              $res = mysqli_query($db, "SELECT * FROM students");
                                              while($row = mysqli_fetch_array($res)) { ?>
                                              <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                            <?php   }     ?>
                                        </select>
                                    </td>
                                </tr>                                    
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_class"value="Submit"></td>
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

<!-- Remove duplicates from students drop down -->
<script>
  var usedNames = {};
  $("select[name='students[]'] > option").each(function () {
      if(usedNames[this.text]) {
          $(this).remove();
      } else {
          usedNames[this.text] = this.value;
      }
  });

</script>
<!-- End duplicate remover  -->

<!-- Multi-Select suport -->
  <link rel="stylesheet" href="vanillaSelectBox.css">
  <script src="vanillaSelectBox.js"></script>
  <script>
    let mySelect = new vanillaSelectBox("#subj",{
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        disableSelectAll: true,
        placeHolder: ""

    });
  </script>
<!-- End multi-select support  -->
  
<?php require_once('../layouts/footer_to_end.php'); ?>
