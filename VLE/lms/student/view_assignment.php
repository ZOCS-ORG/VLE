<?php
	require_once('header.php');
    require '../includes/profile_navbar.php';
    $ass_id = $_GET['ass_id'];
?>

<body>
    <br>
	<div class="container">

	    <div id="test2" class="col s12 m8">
		    <div class="card">
		        <div class="container left-align ">
				   <?php require '../includes/ass_submit_validation.php'; ?>

                   <?php  
                        $sub_query = $db->query("SELECT * FROM ass_notice WHERE id = $ass_id");
                        while($row=$sub_query->fetch_array()){
                            $question_id = $row['id'];
                            $name = $row['name'];
                            $question = $row['question'];
                            $teacher_id = $row['teacher_id'];
                            $file = $row['assFile'];
                            $dueDate = $row['date_due'];
                            $assDate = $row['date'];
                            $marks = $row['marks'];
                            $subject_id = $row['subject_id'];

                            $file_path = "../files/ass_notice/".$file; /**File location */
                    ?>
                    <div class="col s12 m6">
                        <div class="row">
                            <div class="col s6 m6 card-panel darken-2"> <b>Name:</b> <p> <?php echo $name ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Question:</b> <p> <?php echo $question ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>File:</b> <p> <a href="<?php echo $file_path ?>"> File </a>  </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Total Marks:</b> <p> <?php echo $marks ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Date Created:</b> <p> <?php echo $assDate ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Date Due:</b> <p> <?php echo $dueDate ?> </p></div>
                        </div>
                    </div>

                            <br><br>
                    <?php } ?>

                    <div class="">
                        <span class="card-title"><b>Submit below </b></span>
                    </div>
                    <br>
                    <form action="#" method="POST"  enctype="multipart/form-data">
                        <input type="hidden" name="student_id" value="<?php echo $id ?>" />
                        <input type="hidden" name="question_id" value="<?php echo $question_id ?>" />
                        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />

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
		</div>
	</div>

	<?php  ?>

    <?php require '../includes/footer.php' ?>
  <!--  Scripts -->
  
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
  <!-- <script src="../js/materialize.js"></script> -->
  <script src="../js/init.js"></script>
  <script src="../js/script.js"></script>
  
</body>
</html>

<?php  ?>