<?php

require "../includes/connect.php";

if (isset($_POST['submit_notice'])) {

	// return var_dump($_POST['submit_notice']);

	$class = $_POST['class'];
	$subject_id = $_POST['subject_id'];
	$name = $_POST['name'];
	$title = $_POST['title'];
	$file = $_FILES['nFile']['name'];
	$date = date("F j, Y, g:i a");
	move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/noticefiles/" . $file);

	$vidName = $_FILES['file']['name'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$position = strpos($name, ".");
	$fileextension = substr($vidName, $position - 3);
	$fileextension = strtolower($fileextension);

	// return var_dump($fileextension);

	$path = '../files/noticefiles/videos/';
	if (!empty($vidName)) {
		if (($fileextension !== "mp4") && ($fileextension !== "ogg") && ($fileextension !== "avi")) {
			echo $error = "<div class=' text-danger' style='color: red'>The file extension for the 'Suporting Video' must be .mp4, .ogg, or .avi in order to be uploaded </div>";
		} else if (($fileextension == "mp4") || ($fileextension == "ogg") || ($fileextension == "webm")) {
			if (move_uploaded_file($tmp_name, $path . $vidName)) {
			} else {
				echo $error = "<div class=' text-danger' style='color: orange'>  Error: Not Uploading video </div>";
			}
		}
	}

	$query = "INSERT INTO `notices` (`teacher_id`, `class`, `subject_id`, `name`, `title`, `file`, `date`, `video`)
	VALUES ('$t_id', '$class', '$subject_id', '$name', '$title', '$file', '$date', '$vidName')";

	$success = $db->query($query) or die("An error occured: " . mysqli_error($db));

	if ($success) { ?>
		<div class="card-panel green">
			<span class="white-text"><?php echo "Successfully sent your notice to students."; ?>
			</span>
		</div>
	<?php } else { ?>
		<div class="card-panel red">
			<span class="white-text"><?php echo "Some error occured please contact admin"; ?>
			</span>
		</div>
<?php				}
} else {
}






// submit_student_notices
if (isset($_POST['submit_student_notices'])) {

	// return var_dump($_POST['submit_notice']);

	$class = $_POST['class'];
	$subject_id = $_POST['subject_id'];
	$name = $_POST['name'];
	$title = $_POST['title'];
	$file = $_FILES['nFile']['name'];
	$date = date("F j, Y, g:i a");
	move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/noticefiles/" . $file);

	$vidName = $_FILES['file']['name'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$position = strpos($name, ".");
	$fileextension = substr($vidName, $position - 3);
	$fileextension = strtolower($fileextension);

	// return var_dump($fileextension);

	$path = '../files/noticefiles/videos/';
	if (!empty($vidName)) {
		if (($fileextension !== "mp4") && ($fileextension !== "ogg") && ($fileextension !== "avi")) {
			echo $error = "<div class=' text-danger' style='color: red'>The file extension for the 'Suporting Video' must be .mp4, .ogg, or .avi in order to be uploaded </div>";
		} else if (($fileextension == "mp4") || ($fileextension == "ogg") || ($fileextension == "webm")) {
			if (move_uploaded_file($tmp_name, $path . $vidName)) {
			} else {
				echo $error = "<div class=' text-danger' style='color: orange'>  Error: Not Uploading video </div>";
			}
		}
	}

	$query = "INSERT INTO `student_notices` (`student_id`, `class`, `subject_id`, `name`, `title`, `file`, `date`, `video`)
	VALUES ('$s_id', '$class', '$subject_id', '$name', '$title', '$file', '$date', '$vidName')";

	$success = $db->query($query) or die("An error occured: " . mysqli_error($db));

	if ($success) { ?>
		<div class="card-panel green">
			<span class="white-text"><?php echo "Successfully sent your notice to teacher."; ?>
			</span>
		</div>
	<?php } else { ?>
		<div class="card-panel red">
			<span class="white-text"><?php echo "Some error occured please contact admin"; ?>
			</span>
		</div>
<?php				}
} else {
}