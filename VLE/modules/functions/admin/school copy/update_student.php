<?php 
    //require_once('../scripts/student_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good on that🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $student_id = $_GET['id'];
?>

<hr/>

<!-- Remove duplicates from students drop down -->
<script>
  var usedNames = {};
  $("select[name='subjects[]'] > option").each(function () {
      if(usedNames[this.text]) {
          $(this).remove();
      } else {
          usedNames[this.text] = this.value;
      }
  });

</script>
<!-- End duplicate remover  -->

<?php 
    $query = "SELECT  * from students where id = '$student_id' ";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $count = 1;
    if (mysqli_num_rows($result) > 0){                   
        while($row = mysqli_fetch_assoc($result)){ 
?>

<main>
    <div class="container-fluid col-md-9">
        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Update Student Info</h3>
            </div>
            <div class="card-body">
                <form action="update_student.php" method="POST" enctype="multipart/form-data">

                    <table class="table" id="dataTable" width="100%" cellspacing="9">
                        <tr>
                            <td class="text-left">Student Id:</td>
                            <td class="text-right"><input id="stuId"type="text" name="studentId" value="<?php echo $row['id']?>" placeholder="<?php echo $row['id']?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Student Name:</td>
                            <td class="text-right"><input id="name" type="text" name="name" placeholder="<?php echo $row['name']?>"></td>
                        </tr>
                        <tr>
                            <td>Student Username:</td>
                            <td class="text-right"><input type="text" name="username" placeholder="<?php echo $row['username']?>"></td>
                        </tr>
                        <tr>
                            <td>Student Password:</td>
                            <td class="text-right"><input id="password"type="text" name="password" placeholder="New Password"></td>
                        </tr>
                        <tr>
                            <td>Student Phone:</td>
                            <td class="text-right"><input id="phone"type="text" name="phone" placeholder="<?php echo $row['phone']?>"></td>
                        </tr>
                        <tr>
                            <td>Student Email:</td>
                            <td class="text-right"><input id="email"type="text" name="email" placeholder="<?php echo $row['email']?>"></td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td class="text-right"><input type="radio" id="m" name="gender" value="Male" onclick="stuGender = this.value;"><label for="m"> Male <label>
                            <input type="radio" id="f" name="gender" value="Female" onclick="this.value"><label for="f"> Female</label></td>
                        </tr>
                        <tr>
                            <td>Student DOB:</td>
                            <td class="text-right">
                                <input type="" name="stuDOB" id="date1" alt="date" class="IP_calendar" title="Y-m-d">
                            </td>
                        </tr>
                        <tr>
                            <td>Student Admission Date:</td>
                            <td class="text-right">
                                <input type="" name="startDate" id="date2" alt="date" class="IP_calendar" title="Y-m-d">
                            </td>
                        </tr>
                        <tr>
                            <td>Student Address:</td>
                            <td class="text-right"><input id="stuAddress" type="text" name="address" placeholder="<?php echo $row['address']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Parents:</td>
                            <td class="text-right">
                                <select name="parentid" id="parentid">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM parents");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                    <option value="<?php echo $row['id'];?>"> <?php 
                                            echo "Mr. ".$row['fathername']." Mrs. ".$row['mothername']; ?> </option>
                                <?php   }     ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Class:</td>
                            <td class="text-right">
                                <select name="class_id" id="class_id">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM classes");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                    <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                <?php }     ?>
                                </select>                            
                            </td>
                        </tr>

                        <tr>

                            <td>Subjects:</td>
                            <td class="text-right">
                                <select name="subjects[]" multiple="multiple" id="subject">
                                        <?php
                                        // ALREADY SELECTED STUDENTS...
                                        $query ="SELECT subjects.id, subjects.name
                                                FROM subjects
                                                INNER JOIN student_subjects ON subjects.id = student_subjects.subject_id
                                                WHERE student_id = '$student_id' ";
                                        $resultss = mysqli_query($db, $query)or die('Error getting students: '. mysqli_error($db));
                                        while($row_stud = mysqli_fetch_array($resultss)){
                                            $student_name = $row_stud['name'];
                                            $student_id = $row_stud['0'];
                                            //$class_stud_id = $row_stud['id'];
                                    ?>
                                        <option selected value="<?php echo $student_id;?>"> <?php echo $student_name; ?></option>
                                    <?php  } // MESSING UP VANNILA SELECT ?>
                                        <option disabled> Assign subjects to students </option>
                                    <?php
                                        $res = mysqli_query($db, "SELECT * FROM subjects");
                                        while($row = mysqli_fetch_array($res)) { ?>
                                        <option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?> </option>
                                    <?php   }     ?>
                                </select>
                            </td>

                        </tr> 

                        <tr>
                            <td>Student Picture:</td>
                            <td class="text-right"><input id="file"type="file" name="file"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-left"><input class="btn btn-sm btn-secondary " type="submit" name="update_student" value="Submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
        }
    } else {
    echo 'No Records Found!';
    }
?>



<!-- Remove duplicates from students drop down -->
<script>
  var usedNames = {};
  $("select[name='subjects[]'] > option").each(function () {
      if(usedNames[this.text]) {
          $(this).remove();
      } else {
          usedNames[this.text] = this.value;
      }
  });

</script>
<!-- End duplicate remover  -->

<!-- Multi-Select suport -->
    <link rel="stylesheet" href="../../../assets/select_box/vanillaSelectBox.css">
    <script src="../../../assets/select_box/vanillaSelectBox.js"></script>
    <script>
        let mySelect = new vanillaSelectBox("#subject",{
            maxWidth: 500,
            maxHeight: 400,
            minWidth: -1,
            search: true,
            disableSelectAll: true,
            placeHolder: "Assign subjects",
        });
    </script>
<!-- End multi-select support  -->

<?php require_once('../layouts/footer_to_end.php'); ?>
