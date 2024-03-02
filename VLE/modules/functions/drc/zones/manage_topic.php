<?php include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM topics where id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

session_start();
?>

<?php

$drc_id = $_SESSION['id'];

$sql_zone = "SELECT district_id FROM users WHERE id = $drc_id";

$result_zone = mysqli_query($db, $sql_zone);

if (mysqli_num_rows($result_zone) > 0) {

	$row_zone = mysqli_fetch_assoc($result_zone);

	$district_zone = $row_zone['district_id'];
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
	<form action="" id="manage-topic">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title : '' ?>">
			</div>
		</div>
		<input type="hidden" name="district_id" class="form-control" value="<?php echo isset($district_zone) ? $district_zone : '' ?>" readonly>
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Zone</label>
				<select name="category_ids[]" id="category_ids" class="form-control select2" tabindex="1">
					<option value="none">All zones</option> <br>
					<?php
					$query2 = mysqli_query($db, "SELECT * FROM zones WHERE district_id = $district_zone") or die(mysqli_error($db));
					while ($row = mysqli_fetch_array($query2)) {
					?>
						<option value="<?php echo $row['zone_id']; ?>">
							<?php echo $row['zone']; ?>
						</option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Content</label>
				<textarea name="content" class="text-jqte"><?php echo isset($content) ? $content : '' ?></textarea>
			</div>
		</div>
	</form>
</div>

<script>
	$('.select2').select2({
		placeholder: "All",
		width: "100%"
	})
	$('.text-jqte').jqte();
	$('#manage-topic').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_zone_topic',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully saved.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1000)
				}
			}
		})
	})
</script>