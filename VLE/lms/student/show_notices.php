<?php
	require_once('header.php');
?>

<body>

	<?php require '../includes/profile_navbar.php'; ?>
  <div class="row">
    <div class="col s12 m6">
        <div class="card-panel blue">
            <span class="white-text">My Notifications</span>
          </div>
      <?php
        $sub_query = $db->query("SELECT * FROM notices WHERE class='$class' ORDER BY date DESC");
              while($row=$sub_query->fetch_assoc()){ 
              $notice = $row['name'];   
              $date = $row['date'];  
              $teacher_id = $row['teacher_id'];
              $file = $row['file'];

              $sub_query2 = $db->query("SELECT * FROM teachers WHERE id='$teacher_id'");
              while($row=$sub_query2->fetch_assoc()){    
              $tName=$row['name'];
              }       
                 ?>

        <!-- <div class="col s12 m12"> -->

          <?php if(empty($nFile)){ ?>
            <div class="card ">
              <div class="card-content black-text">
                <span class="card-title left-align"><?php echo $tName ?></span><p class="right-align"><?php echo $date ?><p><hr>
                <p><?php echo $notice;?></p>
              </div>
            </div>
          <?php } else { ?>
            <div class="card ">
              <div class="card-content black-text">
                <span class="card-title left-align"><?php echo $tName ?></span><p class="right-align"><?php echo $date ?><p><hr>
                <p><?php echo $notice;?></p>
                <a class="btn blue waves-effect waves-light" href="../files/noticefiles/<?php echo $file ?>" download><?php echo $file?>  <i class="medium material-icons">file_download</i></a>
              </div>
            </div>
           <?php } ?>
               
        <!-- </div> -->
      <?php } ?>
    </div>

    <div class="col s12 m6">
        <div class="card-panel blue">
          <span class="white-text">Assignment notices</span>
        </div>
        <?php require '../includes/ass_submit_validation.php'; ?>
        <?php
          $sub_query3 = $db->query("SELECT * FROM ass_notice WHERE class_id='$class' ");
                while($row1=$sub_query3->fetch_assoc()){
                  $assId = $row1['id'];
                  $ass_subject_id = $row1['subject_id'];
                  $ass_name=$row1['name']; 
                  $ass_question=$row1['question'];   
                  $ass_teacher_id = $row1['teacher_id'];  
                  $assFile = $row1['assFile'];
                  $date_due  = $row1['date_due'];
                  $date_submmited = $row1['date'];
                  $marks = $row1['marks'];

                  $sub_query4 = $db->query("SELECT * FROM teachers WHERE id='$ass_teacher_id'");
                  while($row1 = $sub_query4->fetch_assoc()){    
                    $ass_teacher = $row1['name'];
                  }
                  $sub_query5 = $db->query("SELECT * FROM subjects WHERE id='$ass_subject_id'");
                  while($row3=$sub_query5->fetch_assoc()){    
                    $ass_subject = $row3['name'];     
                  }
        ?>

        <!-- <div class="col s12 m12"> -->

            <div class="card ">
              <div class="card-content black-text">
                <span class="card-title left-align"><?php echo $ass_name ?></span><p class="right-align">Submitted on <?php echo $date_submmited ?><p><hr>
                <p>
                  Subject : <?php echo "<b>$ass_subject</b>" ?><br>
                  Question : <?php echo "<b>$ass_question</b>" ?><br>
                  <?php echo "Marks : <b>$marks</b>";?>
                </p>
                <a class="btn blue waves-effect waves-light" href="../files/ass_notice/<?php echo $assFile ?>" download><?php echo $assFile?>  <i class="medium material-icons">file_download</i></a><hr>
                <p>To be completed before <?php echo $date_due ?></p>
                <form action="#" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="student_id" value="<?php echo $id ?>" />
                    <input type="hidden" name="question_id" value="<?php echo $assId ?>" />
                    <input type="hidden" name="subject_id" value="<?php echo $ass_subject_id ?>" />
                    <input type="hidden" name="assFile" value="<?php echo $ass_question ?>" />

                    <div class="file-field input-field">
                      <div class="btn blue">
                        <span>Browse</span>
                        <input type="file" name="ass_browse" required>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate black-text" type="text" >
                      </div>
                    </div>

                    <span class=" left-align"><button class="waves-effect blue waves-light btn" type="submit" name="ass_submit_direct" value="submit">
                        Submit Assignment   <i class="material-icons right">send</i></button>
                    </span>
                </form>
              </div>
            </div>
               
        <!-- </div> -->
      <?php }?>
    </div>
  </div>


  <?php require '../includes/footer.php'; ?>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
  <!-- <script src="../js/materialize.js"></script> -->
  <script src="../js/init.js"></script>
  <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>

<?php  ?>