<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $inputJSON = file_get_contents("php://input");
    $data = json_decode($inputJSON, true);

    if($data){

        $db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


        $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);

        $item_id = $data['item_id'];

        if(!is_numeric($item_id)){
            die("bad data\n");
        }

        $result = $conn->query("SELECT ingredients FROM items WHERE item_id=$item_id");

        if($result && $result->num_rows > 0){

            $row = $result->fetch_assoc();

            echo($row['ingredients']);

        }
        
        $conn->close();


    }

}



?>