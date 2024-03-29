<?php include('db_connect.php'); ?>

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
				<div class="col-md-12 mb-3">
					<input type="text" id="topic-search" class="form-control" placeholder="Search topics">
				</div>
				<div class="card">
					<div class="card-header">
						<b>Discussions</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_topic">
								<i class="fa fa-plus"></i> Start Discussion</button>
						</span>
					</div>
					<div class="card-body">
						<ul class="w-100 list-group" id="topic-list">
							<?php
							$role = $_SESSION['role'];
							$logged_in = $_SESSION['id'];


							$topic = $db->query("SELECT t.*,u.name FROM topics t inner join users u on u.id = t.user_id
								WHERE audience = '$role' OR audience = '' OR user_id = '$logged_in'
								order by unix_timestamp(date_created) desc");
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
										<a href="index.php?page=view_forum&id=<?php echo $row['id'] ?>" class=" filter-text"><?php echo $row['title'] ?></a>

									</div>
									<hr>
									<p class="truncate filter-text"><?php echo strip_tags($desc) ?> </p>
									<p class="row justify-content-left"><span class=" -success " style="color:#525354!important"><span>Posted By: <?php echo $row['name'] ?></span></span></p>
									<hr>

									<!-- <span class="float-left badge badge-secondary text-white"><?php echo number_format($view) ?> view/s</span> -->
									<span class="float-left label label-lg label-primary text-black ml-2"><i class="fa fa-comments"></i> <?php echo number_format($comments) ?> comments <?php echo $replies > 0 ? " and " . number_format($replies) . ' replies' : '' ?> </span>
									<span class="float-right">

										<span class="info text-info ml-2" style="color: #353535!important">audience: <?php echo ($row['audience'] == 'drc') ? "DEBS" : ucfirst($row['audience']);
																														echo empty($row['audience']) ? 'Everyone' : ''; ?> | </span>

										<a href="index.php?page=view_forum&id=<?php echo $row['id'] ?>" class=" btn btn-primary btn-sm filter-text">Read more</a>

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

		// Handle input event in search field
		$('#topic-search').on('input', function() {
			var searchText = $(this).val().toLowerCase();
			$('#topic-list li').each(function() {
				var title = $(this).find('.filter-text').text().toLowerCase();
				if (title.indexOf(searchText) === -1) {
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		});
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