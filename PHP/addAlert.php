<?php 

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $inputJson = file_get_contents("php://input");
        $data = json_decode($inputJson, true);


        if(!$data){

            echo("no data\n");
            die();

        }

        // echo("email: ". $data['email']. "\n");
        // echo("item_id: ". $data['item_id']."\n");

        if(!isset($data["email"]) || !isset($data["item_id"])){

            echo("no email or item_id\n");
            die();


        }

        $email = $data["email"];
        $item_id = $data["item_id"];


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo("bad email\n");
            die();
        }


        $db_params = parse_ini_file("../config/dbParams.ini");


        $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


        if($conn->connect_error){

            echo("db connect error\n");
            die();
            

        }

        echo("email given: $email\n");

        
        $stmt = $conn->prepare("INSERT INTO emails (email) VALUES (?) ON DUPLICATE KEY UPDATE email_id = LAST_INSERT_ID(email_id)");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $email_id = $conn->insert_id;
        $stmt->close();

        echo("email id found: $email_id \n");

        $stmt = $conn->prepare("INSERT IGNORE INTO alerts (item_id, email_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $item_id, $email_id);
        $stmt->execute();
        $stmt->close();
    } else{

        echo("NOT POST \n");
    }




?>
