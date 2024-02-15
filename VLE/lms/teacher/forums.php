<?php
require_once('header.php');
?>
<style>
	.txt_limit {
		width: 440px;
		white-space: wrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>

<body>

	<?php require '../includes/profile_navbar.php'; ?>

	<div class="row">

		<!-- Notice starts here-->
		<div class="col s12 m4">
			<div class="card ">

				<div class="card-content">
					<span class="card-title">Start a discussion </span>
					<div> <?php require('../includes/forum_validation.php') ?> </div>

					<form action="#" method="POST" enctype="multipart/form-data">
						<div class="row">

							<div class="input-field col s12">
								<textarea id="textarea" class="materialize-textarea" name="topic"></textarea>
								<label for="textarea">Enter discussion here</label>
							</div>

							<div class="file-field input-field col s12">
								<div class="btn">
									<span>Attach Document</span>
									<input type="file" name="file">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
								</div>
							</div>

							<div class="file-field input-field col s12">
								<div class="btn">
									<span>Attach Video</span>
									<input type="file" name="video" /><br><br>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
								</div>
							</div>

							<div class="input-field col s12">
								<select name="audience" required>
									<option value="" disabled selected>Choose Audience</option>
									<option value="All">All</option>
									<?php
									$res = mysqli_query($db, "SELECT user_role FROM users GROUP BY user_role ");
									while ($row = mysqli_fetch_array($res)) { ?>
										<option value="<?php echo $row['user_role']; ?>"> <?php echo $row['user_role']; ?> </option>
									<?php   }     ?>
								</select>

							</div>


						</div>

						<div class="card-action">
							<input class="btn green waves-effect waves-light" type="submit" value="Go!" name="submit_forum">
						</div>
					</form>

				</div>
			</div>
		</div>


		<!-- Past Assignments -->
		<div class="col s12 m8">
			<div class="card-panel">
				<span class="h3">Discussions </span>
			</div>

			<table class="striped highlight responsive-table">
				<thead>
					<tr>
						<th class="txt_limit">Discussion</th>
						<th>Created By </th>
						<th>For</th>
						<th>File</th>
						<th>Video </th>
						<th>Date Created</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$role = $_SESSION['role'];
					// $query = $db->query("SELECT * FROM discussions WHERE audience = '$role' OR  audience = 'All' OR created_by = '$logged_id' ORDER BY id DESC  ");
					$query = $db->query("SELECT * FROM discussions ORDER BY id DESC  ");

					while ($row = $query->fetch_assoc()) {
						$topic = $row['topic'];
						$forum_id = $row['id'];
						$created_by = $row['user_id'];
						$file = $row['file'];
						$video = $row['video'];
						$audience = $row['audience'];
						$timestamp = $row['timestamp'];

						$file_path = "../files/forums/" . $file;
						$video_path = "../files/forums/" . $video;
						/**File location */

						$sub_query2 = $db->query("SELECT * FROM users WHERE id='$created_by' ");
						while ($row = $sub_query2->fetch_assoc()) {
							$user = $row['name'];
						}
					?>
						<tr>
							<td><?php echo $topic ?></td>
							<td><?php echo $user ?></td>
							<td><?php echo $audience ?></td>
							<td> <a href="<?php echo $file_path ?>"> File </a> </td>
							<td> <a href="<?php echo $video_path ?>"> Video </a> </td>
							<td><?php echo $timestamp ?></td>
							<td>
								<a class="btn btn-sm green waves-effect waves-light" href="forum.php?forum_id=<?php echo $forum_id ?>"> View </a>
								<!-- <a class="btn small red waves-effect waves-light" href="notice_ass.php?delete_ass=true&ass_id=<?php echo $ass_id ?>"> Delete </a> -->
							</td>
						</tr>

					<?php } ?>

				</tbody>

			</table>

		</div>

		<!-- Notice ends here -->

	</div>





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