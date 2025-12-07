<?php

    require '../vendor/autoload.php';

    function genHomepage(){

        $template = file_get_contents("../SPHP/indexTemplate.html");

        $homepage_json = file_get_contents("../config/homepageConfig.json");
        $data = json_decode($homepage_json, true);

        if($data){

            $Parsedown = new Parsedown();
            $Parsedown->setSafeMode(true);

            $announcementsHTML = $Parsedown->text($data['announcements']);
            $eventsHTML = $Parsedown->text($data['events']);

            $output = str_replace("ANNOUNCEMENTS", $announcementsHTML, $template);
            $output = str_replace("EVENTS", $eventsHTML, $output);

            file_put_contents("../index.php", $output);

            return 0;


        }

        echo("no data\n");

        return 1;


    }

?>
