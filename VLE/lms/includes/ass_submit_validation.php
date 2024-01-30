<?php

require '../includes/connect.php';
if(isset($_POST['ass_submit'])){
		$student_id = $id;
		error_reporting(0);
		$ass_allowed_file=array("PDF", "pdf", "DOCX", "docx", "DOC", "doc", "TXT", "txt");
		$ext_file=end(explode('.', $_FILES['ass_browse']['name']));
		$end_reg=end(explode('b', $reg_no));

		if(isset($_POST['ass_select_sub'])){ //checking if subname is set 
			$subject_id= $_POST['ass_select_sub'];
		}else{
			$error = $error." Please select a subject";
		}

		if($_POST['ass_q']>0){$ass_id=$_POST['ass_q'];}
		else{
			$error=$error."Pick assignment question";
		}
		
		$date_query=$db->query("SELECT * FROM ass_notice WHERE id='$ass_id' && subject_id='$subject_id' ")
		or die("An error occured: ".mysqli_error($db));
		if($date_query->num_rows){
			//return var_dump($date_query);
			while($row1=$date_query->fetch_assoc()){
				$dueDate=$row1['date_due'];
			}
		} else{ $error=$error." There is no assignment with this assignment name is this subject.<br>";}

		if(in_array($ext_file, $ass_allowed_file)){
			$assFile=$end_reg."_".$ass_id."_".$subject_id."_".$_FILES['ass_browse']['name']; //storing for database
			move_uploaded_file($_FILES['ass_browse']['tmp_name'], "../files/assignment/".$end_reg."_".$ass_id."_".$subject_id."_".$_FILES['ass_browse']['name']); //in file server
		} else{ $error=$error." Please upload files with proper extensions, like 'pdf' or 'docx'"; }

		$assn_query=$db->query("SELECT * FROM assignments WHERE question_id='$ass_id' AND student_id='$student_id' AND subject_id='$subject_id'")
		or die("An error occured: ".mysqli_error($db));
		if($assn_query->num_rows!=0){
			$error= $error." You have already submitted an assignment with same data";
		}

		$curr=date("d-m-Y");
		$expire= new DateTime($dueDate);
		$now= new DateTime($curr);
		// $dueDate->diff($curr)
		$diff=date_diff($expire,$now);
		$diff->format("%R%a days");

		if($date_query->num_rows==1 && empty($error)){
			if($diff->format("%R%a days")<0 || $expire = $curr && empty($error)){
				$assDate=date("Y-m-d"); 
				$late = 'In Time';
				} else { 
					$late = "Late";
				}	
				$ass_insert=$db->query("INSERT INTO assignments (question_id, student_id, subject_id, assFile, date, late) 
									VALUES ('$ass_id', '$student_id', '$subject_id', '$assFile', '$assDate', '$late')")
									or die("An error occured: ".mysqli_error($db));
				if($ass_insert){?>
					<div class="card-panel green">
			          <span class="white-text"><?php echo "Successfully submitted your assignment" ?>
			          </span>
			        </div>
				<?php } else{ ?>
					<div class="card-panel red">
			          <span class="white-text"><?php echo $error=$error." Can't submit your assignment contact admin" ?>
			          </span>
			        </div>
				<?php }

		} else{ ?>
			<div class="card-panel red">
	          <span class="white-text"><?php echo "Error: ".$error ?>
	          </span>
	        </div>
		<?php }

		// $date=date("F j, Y, g:i a");
}



if(isset($_POST['ass_submit_direct'])){
	$student_id = $id;		
	$question_id = $_POST['question_id'];
	$subject_id = $_POST['subject_id'];
	
	error_reporting(0);
	$ass_allowed_file=array("PDF", "pdf", "DOCX", "docx", "DOC", "doc", "TXT", "txt");
	$ext_file=end(explode('.', $_FILES['ass_browse']['name']));
	$end_reg=end(explode('b', $reg_no));

	$date_query=$db->query("SELECT * FROM ass_notice WHERE id='$question_id' && subject_id='$subject_id' ")
	or die("An error occured: ".mysqli_error($db));
	if($date_query->num_rows){
		while($row1=$date_query->fetch_assoc()){
			$dueDate=$row1['date_due'];
			$ass_name = $row1['name'];
		}
	} 

	if(in_array($ext_file, $ass_allowed_file)){
		$assFile=$end_reg."_".$ass_id."_".$subject_id."_".$_FILES['ass_browse']['name']; //storing for database
		move_uploaded_file($_FILES['ass_browse']['tmp_name'], "../files/assignment/".$end_reg."_".$ass_id."_".$subject_id."_".$_FILES['ass_browse']['name']); //in file server
	} else{ $error=$error." Please upload files with proper extensions, like 'pdf' or 'docx'"; }
	
	// $filetmp =$_FILES['file'];       
	// return var_dump($filetmp);

	$assn_query=$db->query("SELECT * FROM assignments WHERE question_id='$question_id' AND student_id='$student_id' AND subject_id='$subject_id'")
	or die("An error occured: ".mysqli_error($db));
	if($assn_query->num_rows!=0){
		$error= $error." You have already submitted this assignment";
	}

	$curr=date("Y-m-d");
	$expire= new DateTime($dueDate);
	$now= new DateTime($curr);
	// $dueDate->diff($curr)
	$diff=date_diff($expire,$now);
	$diff->format("%R%a days");
	echo " echo ";
	if($date_query->num_rows==1 && empty($error)){
		$test = $diff->format("%R%a days");
		var_dump($test);
		if($diff->format("%R%a days") < 0 || $expire = $curr && empty($error)){
			$assDate=date("Y-m-d"); 
			$late = 'In Time';
		} else{ $late = "Late"; }
		

		$ass_insert=$db->query("INSERT INTO assignments (question_id, student_id, subject_id, assFile, date, late) 
							VALUES ('$question_id', '$student_id', '$subject_id', '$assFile', '$assDate', '$late')")
							or die("An error occured: ".mysqli_error($db));
		if($ass_insert){ ?>
			<div class="card-panel green">
				<span class="white-text"><?php echo "Successfully submitted your assignment <br/> "; 
												if ($late == "Late") {
													echo "Late Submition";
												}
											?>
				</span>
			</div>
		<?php } else{ ?>
			<div class="card-panel blue">
				<span class="white-text"><?php echo $error=$error." Can't submit your assignment contact admin" ?>
				</span>
			</div>
		<?php }

	} else{ ?>
		<div class="card-panel red">
		  <span class="white-text"><?php echo "Error: ".$error ?>
		  </span>
		</div>
	<?php }

	// $date=date("F j, Y, g:i a");
}