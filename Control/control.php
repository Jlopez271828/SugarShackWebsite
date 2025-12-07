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

        <title>Control Page</title>
        <link rel="stylesheet" href="control.css">

    </head>

    <body>
        <div id="container">

            <a href="/EditItems"> Add / Edit Items</a>
            <a href="/EditEvents"> Edit Front Page</a>
            <a href="/ViewOrders"> View Orders </a>
            <a href="/NotifyEmailList"> Send to Email List </a>
            <a href="/SendAlerts"> Send Alerts For Items </a>



        </div>

        <div id='mainLink'>
            <a href='/'> <- main site </a>
        </div>
    </body>



</html>

