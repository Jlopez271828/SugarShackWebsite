<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){

    //echo($_SESSION['loggedin']);
    echo('not logged in');
    
    header('Location: /login');

    exit();

}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>View Orders</title>
        <link rel='stylesheet' href='viewOrders.css'>
        <script src='viewOrders.js'></script>
    </head>

    <body>

        <div id='backBtn'> <a id='backA' href='/Control'> <-- go back </a> </div>

        <div id='container'>

        <?php include('../PHP/getOrders.php')?>
        </div>

        <div id='addBtn'></div>

        

    </body>



</html>
