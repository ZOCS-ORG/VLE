<?php
require_once('header.php');
?>

<body>

	<?php require '../includes/profile_navbar.php'; ?>

	<div class="container">
		<div class="row">

			<!-- Notice starts here-->

			<div class="col s12 m6">
				<div class="card">

					<div class="card-content">
						<span class="card-title">Send Notices</span>
						<div> <?php require('../includes/notice_validation.php') ?> </div>

						<form method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="input-field col s12 black-text">

									<input id="title" class=" black-text" name="title" placeholder="Title" />
								</div>
								<div class="input-field col s12">
									<textarea id="textarea" class="materialize-textarea" name="name"></textarea>
									<label for="textarea">Enter your notice here</label>
								</div>

								<!-- file input starts here -->
								<div class="file-field input-field col s12">
									<div class="btn">
										<span>Supporting Document</span>
										<input type="file" name="nFile">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text">
									</div>
								</div>
								<!-- file input ends here -->

								<!-- file input starts here -->
								<div class="file-field input-field col s12">
									<div class="btn">
										<span>Supporting Video</span>
										<input type="file" name="file" /><br><br>
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text">
									</div>
								</div>
								<!-- file input ends here -->

								<div class="input-field col s12">
									<select name="class">
										<option value="" disabled selected>Choose Class</option>
										<?php
										$get_class = $db->query("SELECT * FROM teacher_subject_class WHERE teacher_id = '$t_id' ");
										while ($row1 = $get_class->fetch_assoc()) {
											$class_id = $row1['class_id'];

											$class_query = $db->query("SELECT * FROM classes WHERE id = '$class_id' ");
											while ($row_sub = $class_query->fetch_assoc()) {
												$class_id = $row_sub['id'];
												$class_name = $row_sub['name'];
										?>
												<option value="<?php echo $class_id ?>"><?php echo $class_name ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>

								<div class="input-field col s12">
									<select name="subject_id">
										<option value="" disabled selected>Choose Subject</option>
										<?php
										$get_class = $db->query("SELECT * FROM teacher_subject_class WHERE teacher_id = '$t_id'")
											or die("An error occured: " . mysqli_error($db));
										while ($row1 = $get_class->fetch_assoc()) {
											$subject_id = $row1['subject_id'];

											$sub_query = $db->query("SELECT * FROM subjects WHERE id = '$subject_id'");
											while ($row_sub = $sub_query->fetch_assoc()) {
												$subject_id = $row_sub['id'];
												$subject_name = $row_sub['name'];
										?>
												<option value="<?php echo $subject_id ?>"><?php echo $subject_name ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>

							<div class="card-action">
								<input class="btn blue waves-effect waves-light" type="submit" value="Go!" name="submit_notice">
							</div>
						</form>

					</div>
				</div>

			</div>


			<div class="col s12 m6">
				<div class="card-panel">
					<span class="bold">Past Notices </span>
				</div>
				<?php
				$sub_query = $db->query("SELECT * FROM notices WHERE teacher_id='$t_id' ORDER BY id DESC");
				while ($row1 = $sub_query->fetch_assoc()) {
					$notice = $row1['name'];
					$date = $row1['date'];
					$class = $row1['class'];
					$file = $row1['file'];
					$video = $row1['video'];

					$class_query = $db->query("SELECT * FROM classes WHERE id='$class' ORDER BY name");
					while ($row_class = $class_query->fetch_assoc()) {
						$class_name = $row_class['name'];
					}
				?>
					<div class="col s12 m12">
						<div class="card">
							<div class="card-content">
								<span class="card-title left-align"><?php echo $t_username ?></span>
								<p class="right-align"><?php echo $date ?>
								<p>
									<br> Class = <?php echo $class_name; ?>
									<hr>
								<p><?php echo $notice; ?></p>
								<div>

									<?php if (!empty($video)) { ?>
										<a class="btn blue waves-effect waves-light" href="../files/noticefiles/<?php echo $file ?>">`<?php echo substr($file, +4); ?> <i class="medium material-icons">file_download</i></a>

									<?php } else {
										echo "<div style='color:red;'>Document not found</div>";
									} ?>
									<hr>

									<div class="col-md-8">
										<?php if (!empty($video)) { ?>
											<video width="100%" height="240" controls>
												<source src="../files/noticefiles/videos/<?php echo $video ?>">
											</video>
										<?php } else {
											echo "<div style='color:red;'>Video not found</div>";
										} ?>
									</div>

								</div>
							</div>
						</div>
					</div>

				<?php } ?>
			</div>

			<!-- Notice ends here -->

		</div>
	</div>



	<?php
	require '../includes/footer.php'; ?>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

	<!-- <script src="../js/materialize.js"></script> -->

	<script src="../js/init.js"></script>
	<script src="../js/script.js"></script>
</body>

</html>



<?php ?>