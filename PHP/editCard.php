<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){

    exit();

}

require '../SPHP/generateRepertoire.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputJSON = file_get_contents("php://input");
    $data = json_decode($inputJSON, true);

    // fwrite($output, "recieved data\n\n");
    // fwrite($output, $inputJSON);
    if($data){
        // fwrite($output, "data :)\n");

        // if(!isset($_SESSION['loggedin'])){
        //     // fwrite($output, "\nnot logged in :(\n");
        //     die();
        // }
        // fwrite($output, "logged in :)\n");

	if(!isset($data['item_id']) || !isset($data['title']) || !isset($data['description']) || !isset($data['active']) || !isset($data['selling'])){
		
		echo("bad input\n");
		die();

	}

        $item_id = $data['item_id'];
        $name = $data['title'];
        $description = $data['description'];
        $active = $data['active'];
        $price = $data['price'];
	      $selling = $data['selling'];

        $db_params = parse_ini_file("../config/dbParams.ini");


        $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);

        if($conn->connect_error){

            echo("BAD");	
            die();
            
        
        }

        $state = "false";
        if($active){
            $state = "true";
        }


        // fwrite($output, "UPDATE items SET name='" . $name . "', description='" . $description . "', active=" . $state . ", price=" . $price . " WHERE item_id=" . $item_id);

        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);

        $sql = "UPDATE items SET 
                    name = '$name', 
                    description = '$description', 
                    active = $state, 
                    price = $price 
                    WHERE item_id = $item_id";
        $result = $conn->query($sql);

	if($selling == true){

		$sql = "INSERT INTO currently_selling (item_id)
				Values($item_id)
        ON DUPLICATE KEY UPDATE item_id = item_id
		";

	}
	else{
	
		$sql = "DELETE FROM currently_selling 
				where item_id = $item_id";
	
	}

	$conn->query($sql);

        echo("GOOD");

        genRepertoire();

        // if($result === TRUE){
        //     fwrite($output, "updated db coreect\n");
        // }
        // else{
        //     fwrite($output, "updated db false\n");
        //     fwrite($output, $conn->error);
        // }



    }
    else{
        echo("BAD");
    }


}
else{
    echo("BAD");
}

//fclose($output);
$conn->close();

?>
