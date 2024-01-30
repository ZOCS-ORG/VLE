<?php
	require_once('header.php');
?>

<body>

<style>

</style>



    <?php 
      // error_reporting(0);
      $subject_id= $_GET['subject_id'];
      require '../includes/profile_navbar.php';
    ?>



<div class="row">   

      <div class="col s12 m2">
        <div class="card-panel ">
        <!-- </div><br>
          <div class="card horizontal">
            <div class="card-stacked"> -->
  


            <ul id="slide-out" class="sidenav">
              <li><a href="#!">First Sidebar Link</a></li>
              <li><a href="#!">Second Sidebar Link</a></li>
            </ul>
            <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
            



            </div>
          <!-- </div> </div></div> -->
      </div>


      
      <div class="col s12 offset-2 m8" style="margin-top: 1em;">
        <ul class="tabs">
          <li class="tab col s3"><a href="#assignments">All Assignments</a></li>
          <li class="tab col s3"><a href="#summited">Submmited Assignments</a></li>
        </ul>
      </div>

      
      <div id="assignments" class="col s12 m8" >
        <div class="card-panel blue">
          <span class="white-text">Assignments here</span>
        </div>
          <br>
        <div class="row">



            <table id="all_assignments" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>Name</th>
                    <th class="txt_limit">Queston</th>
                    <th>File</th>
                    <th>Marks</th>
                    <th>Teacher</th>
                    <th>Date Due </th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $query = $db->query("SELECT * FROM ass_notice WHERE subject_id = '$subject_id' ");

                      while($row=$query->fetch_assoc()){
                        $ass_id = $row['id'];
                        $name = $row['name'];
                        $question = $row['question'];
                        $teacher_id = $row['teacher_id'];
                        $file = $row['assFile'];
                        $dueDate = $row['date_due'];
                        $assDate = $row['date'];
                        $marks = $row['marks'];

                        $file_path = "../files/ass_notice/".$file; /**File location */

                        $sub_query2 = $db->query("SELECT * FROM teachers WHERE id='$teacher_id' ");
                        while($row=$sub_query2->fetch_assoc()){    
                          $teacher_name=$row['name'];  
                        } 
                        $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject_id' ");
                        while($row=$sub_query3->fetch_assoc()){    
                          $sub_name=$row['name'];  
                        } 
                  ?>
                  <tr>
                        <td><?php echo $name ?></td>
                        <td><?php echo $question ?></td>
                        <td> <a href="<?php echo $file_path ?>"> File </a>  </td>
                        <td><?php echo $marks ?></td>
                        <td><?php echo $teacher_name ?></td>
                        
                        <td><?php echo $dueDate ?></td>
                        <td><?php echo $assDate ?></td>
                        <td><a class="btn blue waves-effect waves-light" 
                          href="view_assignment.php?ass_id=<?php echo $ass_id; ?>">
                          View<i class="material-icons right">send</i></a>
                        </td>
                      </tr>

                <?php } ?>

              </tbody>
            </table>
        </div>  
      </div>

      <div id="summited" class="col s12 m8" >
        <div class="card-panel blue">
          <span class="white-text"> Submitted Assignments </span>
        </div><br>
        <div class="row">
          <table id="submited">
            <thead>
              <tr>
                <th>Name</th>
                <th class="txt_limit">Queston</th>
                <th>Grade</th>
                <th>Date Due </th>
                <th>Date Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sub_query2 = $db->query("SELECT * FROM assignments WHERE subject_id = '$subject_id' && student_id = '$id' ");
                if($sub_query2->num_rows > 0){
                while($row2 = $sub_query2->fetch_assoc()){
                    $question_id = $row2['question_id'];

                    $ques_query = $db->query("SELECT * FROM ass_notice WHERE id='$question_id'");
                    if($ques_query->num_rows > 0 ){
                      while($q_row=$ques_query->fetch_assoc()){
                        $q_name = $q_row['name'];
                        $question = $q_row['question'];
                        $dueDate = $q_row['date_due'];
                      }
                    }
                    $assFile = $row2['assFile'];
                    $assDate = $row2['date'];


                    $grade_query1 = $db->query("SELECT * FROM results WHERE student_id = '$id' && name = '$q_name' ");
                    if($grade_query1->num_rows > 0){
                      while($grade_row2=$grade_query1->fetch_assoc()){
                        $grade = $grade_row2['marks'];
                      }
                    }
              ?>
              <tr>
                <td><?php echo $q_name; ?></td>
                <td><?php echo $question; ?></td>
                <td><?php if(isset($grade)){ echo $grade;}else{ echo "Not yet graded";} ?></td>
                <td><?php echo $dueDate; ?></td>
                <td><?php echo $assDate; ?></td>
                <td><a class="btn-floating btn-large waves-effect waves-light" href="<?php echo "../files/assignment/".$assFile; ?>"><i class="material-icons right">file_download</i></a></td>
              </tr>

              <?php } } ?>

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
      var table = $('#all_assignments').DataTable({
          "order": [],
          "dom": 'Bfrtip', 
      });
  }); 
  $(document).ready(function (){
      var table = $('#submited').DataTable({
          "order": [],
          "dom": 'Bfrtip', 
      });
  }); 
</script>


    <?php require('../includes/footer.php'); ?>

  <!--  Scripts-->


  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

  <!-- <script src="../js/materialize.js"></script> -->

  <script src="../js/init.js"></script>

  <script src="../js/script.js"></script>

</body>

</html>


<?php  ?>