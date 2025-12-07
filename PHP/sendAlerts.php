<?php 

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
  
  echo("error\n");
  die();
  
}

require '../SPHP/generateEmail.php';

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//$output = fopen("output.txt", "w");

if($_SERVER["REQUEST_METHOD"] === "POST"){

  $db_params = parse_ini_file("../config/dbParams.ini");

  $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);

  $result = $conn->query("select emails.email, items.name from alerts join currently_selling on currently_selling.item_id = alerts.item_id join emails on emails.email_id = alerts.email_id join items on items.item_id = alerts.item_id");
  
//  fwrite($output, "queried\n");
  

  $toSend = [];

  while($row = $result->fetch_assoc()){
    
//    fwrite($output, "adding" . $row['email'] . "\n");

    if(!isset($toSend[$row['email']])){
      
      $toSend[$row['email']] = "- " . $row['name'] . "\n";

    }
    else{
      $toSend[$row['email']] = $toSend[$row['email']] . "- " . $row['name'] . ".\n";
    }

  }

//  foreach($toSend as $email => $text){
    
//    echo("email, text: " . $email . " | " . $text);
//  }


  $Parsedown = new Parsedown();
  $mail = new PHPMailer(true);
  
  $email_params = parse_ini_file("../config/emailParams.ini");
  
  $htmlbody = "";
  $emailbody = "";

  foreach($toSend as $email => $text){
    try{
      
      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->Host = $email_params['host'];
      $mail->SMTPAuth = true;
      $mail->Username = $email_params['username'];
      $mail->Password = $email_params['password'];
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;
      $mail->isHTML(true);
      $mail->Subject = "You're wishlisted items are currently being sold";

      $mail->setFrom($email_params['username'], 'Sugar Shack Notifications');

      $mail->addAddress($email, $email);
      
//      echo("pre parsedown: " . $text . "\n");
      $htmlbody = $Parsedown->text($text);
//      echo("post parsedown: " . $htmlbody . "\n");

      $emailbody = genEmail("Items you requested are being sold!", $htmlbody);

      $mail->Body = $emailbody;

      $mail->send();

//      fwrite($output, "sent email to $email");

    }
    catch (Exception $e) {
      
      echo $e;

    }
  }

}

//fclose($output);


?>
