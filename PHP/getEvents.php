<?php
$db_params = parse_ini_file("/home/ubuntu/website2/config/dbParams.ini");


$conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


if($conn->connect_error){

    echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
    die("DB CONNECT ERROR: " . $conn->connect_error);
    

}

$today = date('Y-m-d') . ' 00:00:00';



$stmt = $conn->prepare("SELECT event_id, event_date, description FROM events WHERE event_data >= ?");
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
$events = $result->fetch_all(MYSQLI_ASSOC);

foreach ($events as $event) {
    echo "<div class='eventBlock' id='". $event['event_id'] ."'></div>";
}
?>