<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️

$sqlEvents = "SELECT id, name, start_date, end_date FROM calendar LIMIT 20";
$resultset = mysqli_query($db, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {	
	// convert  date to milliseconds
	$start = strtotime($rows['start_date']) * 1000;
    $end = strtotime($rows['end_date']) * 1000;
    $id	= $rows['id'];
	$calendar[] = array(
        'id' =>$rows['id'],
        'title' => $rows['name'],
        'url' => "../events/view_event.php?id=$id",
		"class" => 'event-important',
        'start' => "$start",
        'end' => "$end"
    );
}
$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);
echo json_encode($calendarData);
exit;
?>