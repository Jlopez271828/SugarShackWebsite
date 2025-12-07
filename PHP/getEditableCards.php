<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){

    die();
}

$db_params = parse_ini_file("/home/jacob/website1/config/dbParams.ini");


$conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


if($conn->connect_error){

    echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
    die("DB CONNECT ERROR: " . $conn->connect_error);
    

}

$sql = "SELECT item_id, name, description, price, active, seq_no FROM items";
$result = $conn->query($sql);

$selling = [];
$sql2 = "SELECT item_id FROM currently_selling";
$result2 = $conn->query($sql2);
while($row = $result2->fetch_assoc()){

	$selling[$row['item_id']] = true;

}



if($result->num_rows > 0){

	while($row = $result->fetch_assoc()){

        
        if($row['active']){
            $state = " checked ";
        }
        else{
            $state = "";
        }

	if(isset($selling[$row['item_id']])){
		$selling_state = " checked";

	}
	else{
		$selling_state = "";
	}


	    echo("<div class=\"card\" id='" . $row['item_id'] . "'>

			    <div class=\"innerCard\">

                    <div class='imageContainer'>
                        <img src='/images/items/" . $row['item_id'] . ".webp' class='cardImg' id='image_" . $row['item_id'] ."'>
                    </div>

                    <input type='file' class=imageInput id='imageInput_" . $row['item_id'] . "' accept='image/*' >

                    <br>

                    <button class='updateImage' id='updateImage_" . $row['item_id'] ."'> Update Image </button>

                    <h1 contenteditable='true' class='title' id='title_" . $row['item_id'] . "'>" . $row['name'] . "</h1>

                    <p contenteditable='true' class='desc' id='desc_" . $row['item_id'] . "'>" . $row['description'] . "</p>

                    <br>

                    <div class='seperationDiv'>
                    <p3 class='priceTitle'>price: </p3>
                    <p3 class='price' id='price_" . $row['item_id'] . "' contenteditable='true'>" . $row['price'] . "</p3>
                    </div>

                    <div class='seperationDiv'>
                    <label for='activeBtn'>Visible:</label>
                    <input type='checkbox' class='activeBtn' name='activeBtn' id='active_" . $row['item_id'] . "'" . $state . "></input>
                    </div>

                    <div class='seperationDiv'>
                    <label for='sellingCheck'>Currently selling: </label>
                    <input type='checkbox' class='sellingBtn' id='sellingBtn_" . $row['item_id'] . "' name='sellingCheck'" . $selling_state  ."></input>
                    </div>
                    
                    <div>
                    <p class='preSeq'> Sequence number: </p>
                    <p contenteditable='true' class='seqNo' id='seqNo_" . $row['item_id'] . "'> " . $row['seq_no'] .  " </p>
                    </div>

                    <br><br>

                    <button class='updateBtn'>Save Changes</button>
                    <button class='ingredientsBtn'>Update Ingredients</button>


                </div>
	    	</div>");
	
	}
}


?>
