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
        <title>edit Items</title>
        <link rel='stylesheet' href='editItems.css'>
        <script src='editItems.js'></script>
    </head>

    <body>

        <div id='backBtn'> <a id='backA' href='/Control'> <-- go back </a> </div>

        <div id='container'>

        <?php include('../PHP/getEditableCards.php')?>
        </div>

        <div id='addBtn'></div>

        <!-- Modal -->
        <div class="modal-overlay" id="modalOverlay">
        <div class="modal" id="ingredientsModal">
            <textarea id="ingredientsInput"></textarea>
            <div class="error" id="ingredientsError"></div>
            <button id="submitIngredients">Save</button>
            <div class="subscribe-message" id="result"></div>
        </div>
        </div>

        

    </body>



</html>