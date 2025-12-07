<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){

    exit();

}


$db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


$conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


if($conn->connect_error){

    echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
    die("DB CONNECT ERROR: " . $conn->connect_error);
    

}

$sql = "SELECT request_id, contact_info, description, name FROM requests";
$result = $conn->query($sql);


if($result->num_rows > 0){

	while($row = $result->fetch_assoc()){

	    echo("<div class='OrderDiv' id=" . $row['request_id'] . ">
            <h3 class='title'>". $row['name'] ."</h3>
            <p class='contact'>". $row['contact_info'] ."</p>
            <p class='description'>". $row['description'] ."</p>
        
        </div>");
	
	}
}
?>