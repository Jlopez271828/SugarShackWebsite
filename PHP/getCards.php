<?php

$db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


$conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


if($conn->connect_error){

    echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
    die("DB CONNECT ERROR: " . $conn->connect_error);
    

}

$sql = "SELECT item_id, name, description, price FROM items WHERE active=TRUE";
$result = $conn->query($sql);


if($result->num_rows > 0){

	while($row = $result->fetch_assoc()){

	    echo("<div class=\"card\" id='" . $row['item_id'] . "'>

			    <div class=\"innerCard\">

                    <div class='imageContainer'>
                        <img src='/images/items/" . $row['item_id'] .".webp' class='cardImg' id='image_" . $row['item_id'] ."'>
                    </div>

                    <div class = 'titleDesc'>
                    <h1 class='name'>" . $row['name'] . "</h1>

                    <p class='desc'>" . $row['description'] . "</p>
                    </div>


                    <button class='notifyBtn'>Notify me when this item is being sold</button>




                </div>
	    	</div>");
	
	}
}
?>