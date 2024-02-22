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

	<?php 
	
	$drc_id = $_SESSION['id'];


$sql = "SELECT * FROM zones 
INNER JOIN users ON users.district_id = zones.district_id";

$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
  
    $row = mysqli_fetch_assoc($result);
    
    // Get the zone_id
    $zone_id = $row['zone_id'];
    // Get the zone name if needed
    $zone_name = $row['zone'];
}

	?>
		<!-- Notice starts here-->
		<div class="col s12 m4">
			<div class="card ">

				<div class="card-content">
					<span class="card-title">Start a Zone discussion </span>
				<?	echo 'zone' ?>
					<div> <?php require('../includes/forum_zone_validation.php') ?> </div>

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
								<input type="hidden" value="<?php echo $zone_id; ?>" name="zone_id">
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
							<!-- 
							<div class="input-field col s12">
								<select name="audience" required>
									<option value="" disabled selected>Choose Audience</option>
									<option value="All">All</option>
									
								</select>

							</div> -->


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
				<span class="h3">Zone Discussions </span>
			</div>

			<table class="striped highlight responsive-table" id='dis'>
				<thead>
					<tr>
						<th class="txt_limit">Discussion</th>
						<th>Created By</th>
						<!-- <th>For</th> -->
						<th>File</th>
						<th>Video</th>
						<th>Date Created</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$role = $_SESSION['role'];
					// $logged_in_user_id = $_SESSION['id'];
					// $query = $db->query("SELECT * FROM discussions WHERE audience = '$role' OR  audience = 'All' OR created_by = '$logged_id' ORDER BY id DESC  ");
					$query = $db->query("SELECT * FROM zone_discussions WHERE zone_id = '$zone_id' ORDER BY id DESC  ");

					while ($row = $query->fetch_assoc()) {
						$topic = $row['topic'];
						$forum_id = $row['id'];
						$created_by = $row['user_id'];
						$file = $row['file'];
						$video = $row['video'];
						$audience = $row['audience'];
						$timestamp = $row['timestamp'];

						$file_path = !empty($file) ? "../files/forums/$file" : null;
						$video_path = !empty($video) ? "../files/forums/$video" : null;
						/**File location */
						// $is_creator = ($created_by == $logged_in_user_id);
						$sub_query2 = $db->query("SELECT * FROM users WHERE id='$created_by' ");
						while ($row = $sub_query2->fetch_assoc()) {
							$user = $row['name'];
						}
					?>
						<tr>
							<td><?php echo $topic ?></td>
							<td><?php echo $user ?></td>
							<!-- <td><?php echo $audience ?></td> -->
							<td>
            <?php if (!empty($file_path)) : ?>
                <a href="<?php echo $file_path ?>">File</a>
            <?php else : ?>
                N/A
            <?php endif; ?>
        </td>
        <td>
            <?php if (!empty($video_path)) : ?>
                <a href="<?php echo $video_path ?>">Video</a>
            <?php else : ?>
                N/A
            <?php endif; ?>
        </td>

							<td><?php echo $timestamp ?></td>
							<td>
								<a class="btn btn-sm green waves-effect waves-light" href="forum.php?forum_id=<?php echo $forum_id ?>">View</a>
								
									<a class="btn btn-sm warning waves-effect waves-light" href="edit_zone_discussions.php?forum_id=<?php echo $forum_id ?>">Edit</a>
									<button class="btn small red waves-effect waves-light" onclick="deleteDiscussion(<?php echo $forum_id; ?>)">Delete</button>
								
							</td>
						</tr>

					<?php } ?>

				</tbody>

			</table>

			<script>
				function deleteDiscussion(forumId) {
					if (confirm('Are you sure you want to delete this discussion?')) {
						window.location.href = 'delete_discussion.php?forum_id=' + forumId;
					}
				}
			</script>

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