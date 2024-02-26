<?php include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM topics where id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>


<?php
session_start();
$teacher_id = $_SESSION['id'];

$zone_id = null;
$zone_name = null;

$sql = "SELECT z.zone_id, z.zone FROM zones 
INNER JOIN school_teachers st ON st.teacher_id = '$teacher_id'
INNER JOIN schools s ON s.school_id = st.school_id
INNER JOIN zones z ON z.zone_id = s.zone
Group BY z.zone_id;";



$result = mysqli_query($db, $sql);



if (mysqli_num_rows($result) > 0) {

	$row = mysqli_fetch_assoc($result);

	$zone_id = $row['zone_id'];
	// Get the zone name if needed
	$zone_name = $row['zone'];

	// return var_dump($zone_id);
}


// echo $zone_id;
// echo $teacher_id;
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
		<!-- <div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Audience</label>
				<select name="category_ids[]" id="category_ids" class="custom-select select2">
					<option value="">All</option>
					<?php
					$tag = $conn->query("SELECT user_role FROM users GROUP BY user_role");
					while ($row = $tag->fetch_assoc()) :
					?>
						<option value="<?php echo $row['user_role']; ?>"><?php echo ($row['user_role'] == 'drc') ? 'DEBS' : ucfirst($row['user_role']); ?></option>
					<?php endwhile; ?>
				</select>
			</div>
		</div> -->

		<input type="hidden" name="category_ids[]" id="category_ids" class="form-control" value="<?php echo $zone_id ?>">
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