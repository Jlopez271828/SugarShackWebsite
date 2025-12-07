<?php

session_start();

// $output = fopen("output.txt", "w");
// fwrite($output, "function called\n");

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){

    // fwrite($output, "not logged in\n");
    
    die();
    

}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['itemID'])) {
    // fwrite($output, "valid headers\n");
    $uploadDir = '../images/items/';

    // if (!file_exists($uploadDir)) {
    //     fwrite($outpug, "flag A\n");
    //     mkdir($uploadDir, 0777, true); // Ensure directory exists
    //     fwrite($outpug, "flag B\n");
    // }
    // fwrite($output, "flag 0\n");

    $fileName = $_POST['itemID'];
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $targetFile = $uploadDir . $fileName . "." . $extension;
    // fwrite($output, "file extension: " . $extension . "\n");
    // fwrite($output, "file information: ");
    // fwrite($output, $_FILES['file']['name'] . "\n");
    // fwrite($output, "target file: "  . $targetFile);
    

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        
        if($extension !== "webp"){
            
            // fwrite($output, "output of shell exec: \n");
            // fwrite($output, shell_exec("convert " . $targetFile . " " . $uploadDir . $fileName . ".webp"));
            
            shell_exec("cwebp -size 80000 " . $targetFile . " -o " . $uploadDir . $fileName . ".webp");
            unlink($targetFile);

            echo("GOOD");
            
        }else{

            // fwrite($output, "already webp\n");
            echo("GOOD");

        }
        
    } else {
        echo "Failed to upload file.\n";
    }
}
else{
    // fwrite($output, "incorrect headers\n");
}


// fwrite($output, "closing output\n");
// fclose($output);


?>