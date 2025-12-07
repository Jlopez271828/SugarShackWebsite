<?php

    function genRepertoire(){

        $template = file_get_contents("../SPHP/repertoireTemplate.html");

        $db_params = parse_ini_file("../config/dbParams.ini");


        $conn = new mysqli($db_params['host'], $db_params['username'], $db_params['password'], $db_params['dbName']);


        if($conn->connect_error){

            echo("AAAAAAAAAAAAAAAAAAAAAAAAAA");	
            die("DB CONNECT ERROR: " . $conn->connect_error);
            

        }

        $sql1 = "SELECT item_id, name, description, price FROM items WHERE active=TRUE";
        $result1 = $conn->query($sql1);

        $sql2 = "SELECT category_id, name FROM categories";
        $result2 = $conn->query($sql2);

        $cards = '';
        $step = '';
        if($result2->num_rows > 0){

            while($row2 = $result2->fetch_assoc()){

              if($row2['name'] === "misc"){

                $temp_result = $conn->query("SELECT item_id, name, description, price FROM items WHERE active=TRUE AND (category_id=" . $row2['category_id'] . " OR category_id IS NULL)");

              }else{
                $temp_result = $conn->query("SELECT item_id, name, description, price FROM items WHERE active=TRUE AND category_id=" . $row2['category_id']);

              }

              

              $cards = $cards . "<div class=\"category_banner\">". $row2['name'] ."</div>";


              while($row1 = $temp_result->fetch_assoc()){

                $cards = $cards . "<div class=\"card\" id='" . $row1['item_id'] . "'>

                        <div class=\"innerCard\">

                            <div class='imageContainer'>
                                <img src='/images/items/" . $row1['item_id'] .".webp' class='cardImg' id='image_" . $row1['item_id'] ."'>
                            </div>

                            <div class = 'titleDesc'>
                            <h1 class='name'>" . $row1['name'] . "</h1>

                            <p class='desc'>" . $row1['description'] . "</p>
                            </div>

                            <div class='buttonContainer'>
                            <button class='notifyBtn'>Notify me when this item is being sold</button>
                            <button class='ingredientsBtn'>Ingredients</button>
                            </div>



                        </div>
                    </div>";
              }
            
            }
        }

        //$output = fopen("output.txt", 'w');

        //fwrite($output, "TEMPLATE: $template\n\n");
        //fwrite($output, "CARDS: $cards\n\n");
        //fclose($output);

        $page = str_replace("ENTERCARDS", $cards, $template);

        file_put_contents("../Repertoire/repertoire.php", $page);

    }

?>
