<?php
	require_once('header.php');
?>

<body>

	<?php require '../includes/profile_navbar.php'; ?>
	<div class="row">

	    <div id="test2" class="col s12 m8">
		    <div class="card">
		        <div class="container left-align ">
				   <?php require '../includes/ass_submit_validation.php'; ?>
		            <form action="#" method="POST" enctype="multipart/form-data">

			            <div class="card-content black-text">
			              <span class="card-title">Submit assignments</span>
			            </div>
			            
					  	<div class="input-field col s6 black-text">
						    <select name="ass_select_sub" class="black-text">                
				                <?php  
				                $sub_query = $db->query("SELECT * FROM subjects ");
				                while($row=$sub_query->fetch_array()){
				                   $sName=$row['name'];
				                   $sId=$row['id'];
				                   $count=0;
				                   ?>

				                   <option class="black-text" value="<?php echo $sId ?>"><?php echo $sName ?></option> 

				                 <?php } ?>
				            </select>
						    <label>Choose Subject</label>
					  	</div>

					  	<div class="input-field col s6 black-text">
						  	<select name="ass_q" class="black-text">                
				                <?php  
				                $sub_query = $db->query("SELECT * FROM ass_notice ");
				                while($ass_row=$sub_query->fetch_array()){
				                   $assName = $ass_row['name'];
				                   $assId = $ass_row['id'];
				                   $count = 0;
				                   ?>

				                   <option class="black-text" value="<?php echo $assId ?>"><?php echo $assName ?></option> 

				                 <?php } ?>
				        	</select>
				          	<label for="assNum">Choose Assignment</label>
				        </div>

				        <br><br><br><br>
				        <!--practical file input -->
			            <div class="file-field input-field">
					      <div class="btn">
					        <span>Browse</span>
					        <input type="file" name="ass_browse" required>
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate black-text" type="text" >
					      </div>
					    </div>
					    <!--practical file input -->

					    <div class="input-field">
					    	<button class="waves-effect waves-light btn" type="submit" name="ass_submit" value="submit">Submit Assignment<i class="material-icons right">send</i></button>
					    </div>
						    <br><br>
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