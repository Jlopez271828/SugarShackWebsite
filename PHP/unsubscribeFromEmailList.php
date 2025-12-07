<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){



    $inputJson = file_get_contents("php://input");
    $data = json_decode($inputJson, true);

    // $input = fopen("output.txt", "w");

    if(!$data){
        // fwrite($input, "no data");

        echo("BAD");
        echo("no email");
        die();


    }

    if(!isset($data['email'])){
        echo("email not set");
        die();
    }
    $email = $data['email'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $emailErr = "Invalid email format";
        echo("BAD");
        die();

    }
    // else{
    //     echo("GOOD");
    // }


    $db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


    $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


    if($conn->connect_error){

        echo("BAD");	
        die();
        

    }

    $stmt = $conn->prepare("SELECT email_id FROM emails WHERE email = ?");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $stmt->bind_result($email_id);

    $stmt->fetch();

    $stmt->close();
    
    if($email_id){

        $stmt = $conn->prepare("DELETE FROM email_list WHERE email_id = ?");
        $stmt->bind_param("i", $email_id);
        $stmt->execute();
        $stmt->close();

        echo("deleted $email from email list, id = $email_id\n");

        $stmt = $conn->prepare("DELETE FROM alerts WHERE email_id = ?");
        $stmt->bind_param("i", $email_id);
        $stmt->execute();
        $stmt->close();

        echo("deleted $email from alerts");

    } else{

        echo("email not found\n");

    }

    

    











}

















?>
