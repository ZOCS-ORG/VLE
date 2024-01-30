<?php
require_once('license/validate.php');

?>

<?php
//require_once('../../../config/license/validate.php');
//core
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zocs";
$db = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

$query =  "SELECT name,dn FROM school_info ";
$results=mysqli_query($db,$query);
while($row=mysqli_fetch_array($results)){
    $school_name = $row['name'];
    $school_dn = $row['dn'];
}
$app_name = "Chesco School Management System";
$search_placeholder = "TODO!! build a search engine...";
//admin variables
$admin_acc_title = "System Admin Account";

/**
 * ACCOUNTS VARIABLES
 */
/**Tuition fees per month */
// function acc_utils(){
    
$query = "SELECT * from settings";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0){                  
    while($row = mysqli_fetch_assoc($result)){ 

    $total_term_fees = $row['total_term_fees'];

    /** Due dates for paymemts each term.
     * Formar = date('Y-m-d')
     * example 12 Februar, 2021 == 2021-02-12
    */
    //First get current year
    $year = date('Y');
    $date_due_1 = $year.$row['date_due_3'];
    $date_due_2 = $year.$row['date_due_3'];
    $date_due_3 = $year.$row['date_due_3'];
    
    /**Currency used for cash figured */
    $currency = $row['currency']; //Zambian Kwacha...
    }
}
// }

// acc_utils();



