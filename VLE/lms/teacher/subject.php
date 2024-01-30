<?php
	require_once('header.php');
?>

<body>



    <?php 
      error_reporting(0);
      require '../includes/profile_navbar.php'; 
      $class_id = $_GET['class_id'];
      $subject_id= $_GET['sub_id'];
      $sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class_id' ");
      while($row=$sub_query2->fetch_assoc()){    
        $class_name=$row['name'];  
      } 
      $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject_id' ");
      while($row1 = $sub_query3->fetch_assoc()){    
        $sub_name = $row1['name'];  
      }
      
    ?>



<div class="row">

      <!-- search column starts here -->
        <div class="col s12 m2">
          <div class="card-panel ">
          </div><br> <br>
        </div>
      <!-- search column ends here -->

      <br> </br>
      <div id="ass" class="col s12 m8" >

        <div class="card-panel blue">
          <span class="white-text">All My Assignments for <?php echo $class_name." ".$sub_name ?> </span>
        </div>
        <br>

        <div class="row">
              <table id="table1" class="responsive-table striped">

                <thead>
                  <tr>
                    <th>Name</th>
                    <th class="txt_limit">Question</th>
                    <th>Date Created</th>
                    <th>Date Due</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>

                  <?php
                    $select2_query = $db->query("SELECT * FROM ass_notice WHERE 
                        teacher_id = '$t_id' && subject_id = '$subject_id' && class_id = '$class_id'");

                    while($row=$select2_query->fetch_assoc()){
                      $name = $row['name'];
                      $question = $row['question'];
                      $date_created = $row['date'];
                      $date_due = $row['date_due'];
                      $ass_id = $row['id'];
                  ?>
                    <tr>
                      <td> <?php echo $name ?> </td>
                      <td> <?php echo $question ?> </td>
                      <td> <?php echo $date_created ?> </td>
                      <td> <?php echo $date_due ?> </td>

                      <td><a class="btn blue waves-effect waves-light" 
                          href="view_ass_notice.php?ass_id=<?php echo $ass_id."&class_id=".$class_id."&sub_id=".$subject_id; ?>">
                          View<i class="material-icons right">send</i></a>
                      </td>

                    </tr>

                     <?php } ?>       

                </tbody>

              </table>

       </div>  

      </div>



    <!-- reg srch column starts here -->

      <div class="col s12 m2">


      </div>

    <!-- reg srch column starts here   -->

</div>



<script>
  $(document).ready(function (){
      var table = $('#table1').DataTable({
          "order": [],
          "dom": 'Bfrtip', 
      });
  }); 
  $(document).ready(function (){
      var table = $('#table2').DataTable({
          "order": [],
          "dom": 'Bfrtip', 
      });
  }); 
</script>

    <?php require '../includes/footer.php'; ?>

  <!--  Scripts-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

  <!-- <script src="../js/materialize.js"></script> -->

  <script src="../js/init.js"></script>

  <script src="../js/script.js"></script>

</body>

</html>


<?php  ?>