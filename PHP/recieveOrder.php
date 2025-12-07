<?php

$db_params = parse_ini_file("../config/dbParams.ini");


$conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if($conn->connect_error){

    echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
    die("DB CONNECT ERROR: " . $conn->connect_error);
    

}

// $contact = htmlspecialchars();

// $sql = "INSERT INTO requests contact_info, done, description VALUES";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputJSON = file_get_contents("php://input");
    $data = json_decode($inputJSON, true);

    if($data){

        $contact = $data['contact'];
        $description = $data['description'];
        $name = strtolower(preg_replace("/[^a-zA-Z' -]/", "", $data['name']));
        $done = intval(false);

        $stmt = $conn->prepare("INSERT INTO requests(contact_info, done, description, name) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("siss", $contact, $done, $description, $name);

        $stmt->execute();

        echo("Added to database\n");

        $email_params = parse_ini_file("../config/emailParams.ini");
        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();
            $mail->Host = $email_params['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $email_params['username'];
            $mail->Password = $email_params['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email_params['username'], 'SERVER');
            $mail->addAddress($email_params['username'], 'SERVER');

            $mail->Subject = 'ORDER RECIEVED FROM ' . $name;
            $mail->Body = 'Contact info: ' . $contact . "\n\nRequest: " . $description;

            $mail->send();

            echo("mail sent\n");

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        

    }
}





?>
