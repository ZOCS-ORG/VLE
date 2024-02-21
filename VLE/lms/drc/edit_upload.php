<?php
require_once('header.php');
?>

<body>

	<?php 
		require '../includes/profile_navbar.php';
		$ass_id = $_GET['ass_id'];
	?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['ass_id']) && isset($_POST['name']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['description'])) {

        $ass_id = $_POST['ass_id'];
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $from = mysqli_real_escape_string($db, $_POST['from']);
        $to = mysqli_real_escape_string($db, $_POST['to']);
        $description = mysqli_real_escape_string($db, $_POST['description']);


        if ($_FILES['file']['size'] > 0) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];

     
            $file_destination = "../files/ass_notice/" . $file_name;
            move_uploaded_file($file_tmp, $file_destination);

     
            $update_file_query = "UPDATE upload_materials SET file = '$file_name' WHERE id = '$ass_id'";
            mysqli_query($db, $update_file_query);
        }

   
        $update_query = "UPDATE upload_materials SET name = '$name', from_age = '$from', to_age = '$to', description = '$description' WHERE id = '$ass_id'";
        if (mysqli_query($db, $update_query)) {
            echo "<script>alert('Record updated successfully')</script>";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    } else {
        echo "All fields are required";
    }
} else {
    // echo "Form not submitted";
}
?>


	<div class="row">

		<div class="col-md-8 s12 m8">
			<div class="card-panel" style="text-align:center;">
				
				<?php

if (isset($_GET['ass_id'])) {
 
    $ass_id = $_GET['ass_id'];

    $query = $db->query("SELECT * FROM upload_materials WHERE id='$ass_id'");
    $row = $query->fetch_assoc();

	echo "<button class='btn waves-effect waves-light' onclick='window.history.back();' style='display: inline-block; margin-right: 10px;'>Back</button>";
	echo"<br>";
	echo"<br>";


	echo "<span class='center'>Update " . $row['name'] . "</span>";

    if ($row) {
        $name = $row['name'];
        $description = $row['description'];
        $from = $row['from_age'];
        $to = $row['to_age'];
       
?>
        <form method="POST" action="" enctype="multipart/form-data" style="width:60rem; margin-left:auto; margin-right:auto;">
                                    <input type="hidden" name="ass_id" value="<?php echo $ass_id ?>">
                                    <div class="input-field">
                                        <input id="name" type="text" name="name" value="<?php echo $name ?>" required>
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="input-field">
                                        <input id="from" type="text" name="from" value="<?php echo $from ?>" required>
                                        <label for="from">From</label>
                                    </div>
                                    <div class="input-field">
                                        <input id="to" type="text" name="to" value="<?php echo $to ?>" required>
                                        <label for="to">To</label>
                                    </div>
                                    <div class="input-field">
                                        <textarea id="description" class="materialize-textarea" name="description" required><?php echo $description ?></textarea>
                                        <label for="description">Description</label>
                                    </div>
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" name="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                    <button class="btn waves-effect waves-light" type="submit">Update</button>
                                </form>
<?php
    } else {
        echo "No data found for this ID.";
    }
} else {
    echo "No ass_id provided in the URL.";
}
?>

			</div>

			

		</div>

	

	</div>







	<?php ; ?>



	<?php require '../includes/footer.php'; ?>

	<!--  Scripts-->

	<!-- <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> -->

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

	<!-- <script src="../js/materialize.js"></script> -->

	<script src="../js/init.js"></script>

	<script src="../js/script.js"></script>

</body>

</html>



<?php ?>