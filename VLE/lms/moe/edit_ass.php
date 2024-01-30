<?php
require_once('header.php');
?>

<body>

	<?php 
		require '../includes/profile_navbar.php';
		$ass_id = $_GET['ass_id'];
	?>

	<div class="row">

		<!-- Notice starts here-->
		<div class="col s12 m4">
			<div class="card ">
				<?php require '../includes/ass_validation.php' ?>
				<div class="card-content ">
					<span class="card-title"> Edit assignment notice</span>
					<form action="#" method="post" enctype="multipart/form-data">

						<?php
						$query = $db->query("SELECT * FROM ass_notice WHERE id='$ass_id' ");

						while ($row = $query->fetch_assoc()) {
							$name1 = $row['name'];
							$question1 = $row['question'];
							$subject1 = $row['subject_id'];
							$class1 = $row['class_id'];
							$marks1 = $row['marks'];
							$dueDate1 = $row['date_due'];
							$assDate1 = $row['date'];
							$ass_id1 = $row['id'];

							$file_path = "../files/ass_notice/" . $file1;
							/**File location */

							$sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class1' ");
							while ($row = $sub_query2->fetch_assoc()) {
								$class_name1 = $row['name'];
							}
							$sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject1' ");
							while ($row = $sub_query3->fetch_assoc()) {
								$sub_name1 = $row['name'];
							}
						?>

							<div class="row">

								<div class="input-field col s12">
									<textarea id="textarea" class="materialize-textarea" name="name" placeholder="<?php echo $name1 ?> "></textarea>
									<label for="textarea">Assignment title</label>
								</div>

								<div class="input-field col s12">
									<textarea id="textarea" class="materialize-textarea" name="question" placeholder="<?php echo $question1; ?> "></textarea>
									<label for="question">Assignment Question, and Instructions</label>
								</div>

								<div class="input-field col s12">
									<input id="number" type="number" class="materialize-textarea" name="marks" placeholder="<?php echo $marks1 ?> ">
									<label for="question">Total marks</label>
								</div>

								<!-- file input starts here -->
								<div class="file-field input-field col s12">
									<div class="btn ">
										<span>File</span>
										<input type="file" name="nFile">
									</div>
									<div class="file-path-wrapper ">
										<input class="file-path validate " type="text">
									</div>
								</div>
								<!-- file input ends here -->

								<div class="input-field col s12">
									<select name="class">
										<option value="" disabled selected>Class </option>
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
									<select name="subject">
										<option value="" disabled selected>Choose Subject</option>
										<?php
										$get_sub = $db->query("SELECT * FROM teacher_subject_class WHERE teacher_id = '$t_id' ");

										while ($row2  = $get_sub->fetch_assoc()) {
											$sub_id = $row2['subject_id'];

											$sub_name_q = $db->query("SELECT * FROM subjects WHERE id = '$sub_id' GROUP BY name ");
											while ($row_sub2 = $sub_name_q->fetch_assoc()) {
												$sub_id = $row_sub2['id'];
												$sub_name = $row_sub2['name'];
										?>
												<option value="<?php echo $sub_id ?>"><?php echo $sub_name ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>

								<div class="file-field input-field col s12">
									<div type="date" class="btn datepicker ">
										<span>Due Date</span>
									</div>

									<div class="file-path-wrapper ">
										<input type="date" id="dueDate" name="date_due" class="datepicker">
									</div>
								</div>

								<input type="hidden" name="id" value="<?php echo $row['id']?>">

							</div>

							<div class="card-action">
								<button class="btn blue waves-effect waves-light" type="submit" name="update_ass_q">Update
									<i class="material-icons right">send</i>
								</button>
							</div>

						<?php } ?>

					</form>
				</div>
			</div>
		</div>


		<!-- Past Assignments -->
		<div class="col s12 m8">
			<div class="card-panel">
				<span class="">Past assignments </span>
			</div>

			<table class="striped highlight responsive-table">
				<thead>
					<tr>
						<th data-field="ass_no">Name</th>
						<th class="txt_limit" data-field="q">Queston</th>
						<th data-field="subject">Subject</th>
						<th data-field="class">Class</th>
						<th data-field="file">File</th>
						<th data-field="final_daet">Date Due </th>
						<th data-field="date">Date Created</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$query = $db->query("SELECT * FROM ass_notice WHERE teacher_id='$t_id' ");

					while ($row = $query->fetch_assoc()) {
						$name = $row['name'];
						$question = $row['question'];
						$subject = $row['subject_id'];
						$class = $row['class_id'];
						$file = $row['assFile'];
						$dueDate = $row['date_due'];
						$assDate = $row['date'];
						$ass_id = $row['id'];

						$file_path = "../files/ass_notice/" . $file;
						/**File location */

						$sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class' ");
						while ($row = $sub_query2->fetch_assoc()) {
							$class_name = $row['name'];
						}
						$sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject' ");
						while ($row = $sub_query3->fetch_assoc()) {
							$sub_name = $row['name'];
						}
					?>
						<tr>
							<td><?php echo $name ?></td>
							<td><?php echo $question ?></td>
							<td><?php echo $sub_name ?></td>
							<td><?php echo $class_name ?></td>
							<td> <a href="<?php echo $file_path ?>"> File </a> </td>
							<td><?php echo $dueDate ?></td>
							<td><?php echo $assDate ?></td>
							<td>
								<a class="btn btn-sm blue waves-effect waves-light" href="edit_ass.php?ass_id=<?php echo $ass_id ?>"> Edit </a>
								<a class="btn small red waves-effect waves-light" href="delete_ass.php?ass_id=<?php echo $ass_id ?>"> Delete </a>
							</td>
						</tr>

					<?php } ?>

				</tbody>

			</table>

		</div>

		<!-- Notice ends here -->

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