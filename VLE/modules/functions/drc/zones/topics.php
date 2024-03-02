<?php include('db_connect.php'); ?>

<?php

$drc_id = $_SESSION['id'];

$sql_zone = "SELECT district_id FROM users WHERE id = $drc_id";

$result_zone = mysqli_query($db, $sql_zone);

if (mysqli_num_rows($result_zone) > 0) {

	$row_zone = mysqli_fetch_assoc($result_zone);

	$district_zone = $row_zone['district_id'];
	// echo $district_zone;
}


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
// echo $zone_id;
?>
<div class="container-fluid">
	<style>
		input[type=checkbox] {
			/* Double-sized Checkboxes */
			-ms-transform: scale(1.5);
			/* IE */
			-moz-transform: scale(1.5);
			/* FF */
			-webkit-transform: scale(1.5);
			/* Safari and Chrome */
			-o-transform: scale(1.5);
			/* Opera */
			transform: scale(1.5);
			padding: 10px;
		}

		.list-group-item+.list-group-item {
			border-top-width: 1px !important;
		}
	</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Zone Discussions</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_topic">
								<i class="fa fa-plus"></i> Start Zone Discussion</button>
						</span>
					</div>
					<div class="card-body">
						<ul class="w-100 list-group" id="topic-list">
							<?php
							$role = $_SESSION['role'];
							$logged_in = $_SESSION['id'];


							$topic = $db->query("SELECT t.*,u.name, z.zone AS zone_name FROM topics t Left join users u on u.id = t.user_id
							    Left join zones z on z.zone_id = t.audience 
								WHERE (audience = '$zone_id' OR audience ='none' OR user_id = '$logged_in') AND (t.district_id = '$district_zone' AND audience !='')
								order by unix_timestamp(date_created) desc") or die("Cant fetch " . mysqli_error($db));
							while ($row = $topic->fetch_assoc()) :

								$trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
								unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
								$desc = strtr(html_entity_decode($row['content']), $trans);
								$desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
								$view = $db->query("SELECT * FROM forum_views where topic_id=" . $row['id'])->num_rows;
								$comments = $db->query("SELECT * FROM comments where topic_id=" . $row['id'])->num_rows;
								$replies = $db->query("SELECT * FROM replies where comment_id in (SELECT id FROM comments where topic_id=" . $row['id'] . ")")->num_rows;


							?>
								<li class="list-group-item mb-4 bg-grey border-success" style="background-color: #F8F9FC">
									<div>
										<?php if ($_SESSION['id'] == $row['user_id'] || $_SESSION['role'] == 'admin') : ?>
											<div class="dropleft float-right mr-4">
												<a class="text-dark" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="fa fa-ellipsis-v"></span>
												</a>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item edit_topic" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">Edit</a>
													<a class="dropdown-item delete_topic" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">Delete</a>
												</div>
											</div>
										<?php endif; ?>
										<span class="float-right mr-4"><small><i>Created: <?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></i></small></span>
										<a href="index_zone.php?page=view_forum&id=<?php echo $row['id'] ?>" class=" filter-text"><?php echo $row['title'] ?></a>

									</div>
									<hr>
									<p class="truncate filter-text"><?php echo strip_tags($desc) ?> </p>
									<p class="row justify-content-left"><span class=" -success " style="color:#525354!important"><span>Posted By: <?php echo $row['name'] ?></span></span></p>
									<hr>

									<!-- <span class="float-left badge badge-secondary text-white"><?php echo number_format($view) ?> view/s</span> -->
									<span class="float-left label label-lg label-primary text-black ml-2"><i class="fa fa-comments"></i> <?php echo number_format($comments) ?> comments <?php echo $replies > 0 ? " and " . number_format($replies) . ' replies' : '' ?> </span>
									<span class="float-right">

										<span class="info text-info ml-2" style="color: #353535!important">zone name: <?php echo ($row['zone_name'] == '') ? 'All Zones' : $row['zone_name']; ?> | </span>


										<a href="index_zone.php?page=view_forum&id=<?php echo $row['id'] ?>" class=" btn btn-primary btn-sm filter-text">Read more</a>

									</span>
								</li>
							<?php endwhile;  ?>
						</ul>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}

	img {
		max-width: 100px;
		max-height: 150px;
	}
</style>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})
	$('#topic-list').JPaging({
		pageSize: 15,
		visiblePageSize: 10

	});

	$('#new_topic').click(function() {
		uni_modal("Start Discussion", "manage_topic.php", 'mid-large')
	})

	$('.edit_topic').click(function() {
		uni_modal("Edit Topic", "manage_topic.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.delete_topic').click(function() {
		_conf("Are you sure to delete this topic?", "delete_topic", [$(this).attr('data-id')], 'mid-large')
	})

	function delete_topic($id) {
		// start_load()
		$.ajax({
			url: 'ajax.php?action=delete_topic',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>