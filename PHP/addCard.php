<?php 

    session_start();

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true){
        die();
    }

    $db_params = parse_ini_file("../config/dbParams.ini");


    $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


    if($conn->connect_error){

        //echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
        die("DB CONNECT ERROR: " . $conn->connect_error);
        

    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $result = $conn->query("INSERT INTO items(name, description, price, active) VALUES('A', 'A', 1, true)");
        $lastID = $conn->insert_id;

        echo($lastID);
        // echo("1234");

    }else{

        //echo(":(");

    }


?>