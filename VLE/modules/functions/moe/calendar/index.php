<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');
?>

<link rel="stylesheet" href="css/calendar.css">
<div class="container" style="padding-left:80px;">	

	<div class="page-header">
		<div class="row">
			<!-- Date shown on callendar shows down here -->
			<h3 style="padding-top:10px" class="text-success col-md-5 h4"></h3>
			<div class="text-right form-inline">
				<div class="btn-group">
					<button class="btn btn-sm btn-success" data-calendar-nav="prev"><< Prev</button>
					<button class="btn btn-sm btn-default" data-calendar-nav="today">Today</button>
					<button class="btn btn-sm btn-success" data-calendar-nav="next">Next >></button>
				</div>
				<div class="btn-group text-right">
					<button class="btn btn-sm btn-warning" data-calendar-view="year">Year</button>
					<button class="btn btn-sm btn-warning active" data-calendar-view="month">Month</button>
					<button class="btn btn-sm btn-warning" data-calendar-view="week">Week</button>
					<button class="btn btn-sm btn-warning" data-calendar-view="day">Day</button>
				</div>
			</div>
		<div>
	</div>
	
	<span style="pading:30px"> <p></p>	</span>

	<div class="row" style="padding-bottom:50px; padding-top:30px">
		<div class="col-md-9">
			<div id="showEventCalendar"></div>
		</div>
		<div class="col-md-3">
			<h4>All events</h4>
			<ul id="eventlist" class="nav nav-list"></ul>
		</div>
	</div>	

</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>
<?php 
    include_once('../layouts/footer_to_end.php');

?>
