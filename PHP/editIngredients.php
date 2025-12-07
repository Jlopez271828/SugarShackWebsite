<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){

    exit();

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $inputJSON = file_get_contents("php://input");
    $data = json_decode($inputJSON, true);

    if($data){

        $db_params = parse_ini_file("../config/dbParams.ini");


        $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);

        $stmt = $conn->prepare("UPDATE items SET ingredients=? WHERE item_id=?");
        $stmt->bind_param("si", $data['ingredients'], $data['item_id']);

        $stmt->execute();

        echo("updated ingredients\n");

        $stmt->close();
        $conn->close();


    }

}



?>
