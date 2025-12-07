<?php 

session_start();
echo(exec("whoami"));
//$output = fopen("output.txt", "w");

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){

    echo("not logged in\n");
    die();
}

$db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


$conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);

//fwrite($output, "connected to DB\n");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/jacob/website1/SPHP/generateEmail.php';

require '/home/jacob/website1/vendor/autoload.php'; // Ensure the path is correct


//fwrite($output, "loaded libs\n");

if($conn->connect_error){

    echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
    die("DB CONNECT ERROR: " . $conn->connect_error);
    

}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputJSON = file_get_contents("php://input");
    $data = json_decode($inputJSON, true);

    if($data){

        if(!isset($data['message']) || !isset($data['subject']) || !isset($data['title']) || !isset($data['selfonly'])){

            echo("no data or subject or title or selfonly\n");
            die();

        }

        $message = $data['message'];
        $subject = $data['subject'];
        $title = $data['title'];
        $selfonly = $data['selfonly'];

        if(!$selfonly){
            $result = $conn->query("SELECT email_list.email_list_id, emails.email FROM email_list JOIN emails ON email_list.email_id = emails.email_id");

            $recipients = $result->fetch_all(MYSQLI_ASSOC);
        }
        // echo(json_encode($rows));
        $email_params = parse_ini_file("/home/jacob/website1/config/emailParams.ini");
        $mail = new PHPMailer(true);

        $Parsedown = new Parsedown();
        $Parsedown->setSafeMode(true);
        $innerhtml = $Parsedown->text($data['message']);
        $html = genEmail($title, $innerhtml);


        try{

            $mail->isSMTP();
            $mail->Host = $email_params['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $email_params['username'];
            $mail->Password = $email_params['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email_params['username'], 'Sugar Shack Email List');
            $mail->addAddress($email_params['username'], 'Sugar Shack');

            if(!$selfonly){
                foreach ($recipients as $recipient) {
                    $mail->addBCC($recipient['email'], $recipient['email']);
                }
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $html;
            $mail->AltBody = $data['message'];

            $mail->send();

            echo("mail sent\n");

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        

    }
}

//fclose($output);
?>
