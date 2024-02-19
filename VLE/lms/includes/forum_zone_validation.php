<?php

require "../includes/connect.php";

if (isset($_POST['submit_forum'])) {

	$topic = mysqli_real_escape_string($db, $_POST['topic']);
	$raw_zone = mysqli_real_escape_string($db, $_POST['zone_id']);

    $zone = intval($raw_zone);
	// $audience = mysqli_real_escape_string($db, $_POST['audien$audience']);	
	$file = $_FILES['file']['name'];
	$date = date("F j, Y, g:i a");
	move_uploaded_file($_FILES['file']['tmp_name'], "../files/forums/" . $file);

	

	$vidName = $_FILES['video']['name'];
	$tmp_name = $_FILES['video']['tmp_name'];
	$position = strpos($name, ".");
	$fileextension = substr($vidName, $position - 3);
	$fileextension = strtolower($fileextension);

	// return var_dump(($zone));

	$path = '../files/forums/';
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

	$query = "INSERT INTO `zone_discussions` (`user_id`, `topic`, `file`, `video`, `zone_id`)
	VALUES ('$t_id', '$topic', '$file', '$vidName', '$zone')";

	$success = $db->query($query) or die("An error occured : " . mysqli_error($db));

	if ($success) { ?>
		<div class="card-panel green">
			<span class="white-text"><?php echo "Discussion Started Successfully."; ?>
			</span>
		</div>
	<?php } else { ?>
		<div class="card-panel red">
			<span class="white-text"><?php echo "Some error occured, please contact admin"; ?>
			</span>
		</div>
<?php				}
} else {
}


