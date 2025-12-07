<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){

    echo("not logged in\n");
    die();
}

require '/home/jacob/website1/vendor/autoload.php';
require '/home/jacob/website1/SPHP/generateHomepage.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputJSON = file_get_contents("php://input");
    $inputData = json_decode($inputJSON, true);

    $configJSON = file_get_contents("../config/homepageConfig.json");
    $configData = json_decode($configJSON, true);

    if($inputData && $configData){

        if(!isset($inputData['events']) || !isset($configData['events']) || !isset($inputData['announcements']) || !isset($configData['announcements'])){

            echo("no inputData or configData\n");
            die();

        }

        $configData['events'] = $inputData['events'];
        $configData['announcements'] = $inputData['announcements'];

        $configJSON = json_encode($configData, JSON_PRETTY_PRINT);

        file_put_contents("../config/homepageConfig.json", $configJSON);

        $result = genHomepage();

        if($result){

            echo("Error\n");

        }




    }

}








?>