<!DOCTYPE html>
<html>

    <head>
        <title> Add / Edit Live Items </title>
        <link rel="stylesheet" href="liveItems.css">
    </head>

    <body>

        <div id="main">
            <div class='actionDiv'> Start Selling with these items </div>
            <div class='actionDiv'> Add item </div>
            <div class='actionDiv'> clear items </div>
            <div class='actionDiv'> Send Alerts </div>
            <br>
        </div>

        <div id="itemListContainer">

            <?php include("../PHP/getLiveItemList.php")?>

        </div>


    </body>



</html>