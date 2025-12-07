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
        else{
            echo("GOOD");
        }


        $db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


        $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


        if($conn->connect_error){

            echo("BAD");	
            die();
            

        }

        $stmt1 = $conn->prepare("INSERT INTO emails (email) VALUES (?) ON DUPLICATE KEY UPDATE email=email");

        $stmt1->bind_param("s", $email);

        $stmt1->execute();

        $email_id = 0;

        $stmt2 = $conn->prepare("SELECT email_id FROM emails WHERE email = ?");
        $stmt2->bind_param("s", $email);
        $stmt2->execute();
        $stmt2->bind_result($email_id);
        // echo("email id: " . $email_id);
        $stmt2->fetch();
        $stmt2->close();

        $stmt3 = $conn->prepare("INSERT INTO email_list (email_id) VALUES (?) ON DUPLICATE KEY UPDATE email_id=email_id");
        $stmt3->bind_param("i", $email_id);
        $stmt3->execute();

        echo("added $email to email list, id = $email_id\n");




    }


?>