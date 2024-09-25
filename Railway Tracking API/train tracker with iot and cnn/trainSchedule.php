<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body style="padding: 5%; background-image: url(./images/train2.jpeg);">
        <!-- Application header with inline styling -->
        <div class="header" style="padding: 0;height: 40vh; background: none;">
            <h1>TRAIN API</h1>
            <h3>A RESTful API to get up to date
                railway information.
            </h3> 
        </div>
        <?php

            $t_no = $_GET['t_no']; // variable to get train number from index.html.

            // Create a variable containing the url to the Train API.
            $url_traindetails = "https://api.railwayapi.site/api/v1/trains/".$t_no."? fullSchedule=false";

            // Assign $data the function used to collect data from the url
            $data = file_get_contents($url_traindetails);
            $json = json_decode($data,true);

            // Create a table display information gotten from the url
            $i =0;
            echo "<table border=1><tr><td>S.No.</td><td>Train id</td><td>Train Name</td><td>Train Number</td>";
            echo "<td>Station of Departure</td><td>Station of Arrival</td><td>Time of Departure</td>";
            echo "<td>Time of Arrival</td><td>Duration of Travel</td></tr>";
            while(isset($json['data'][$i]['id'])){
                $num = $i + 1;
                echo "<tr><td>".$num."</td>";
                echo "<td>". $json['data'][$i]['id'] ."</td>";
                echo "<td>". $json['data'][$i]['trainName'] ."</td>";
                echo "<td>". $json['data'][$i]['trainNumber'] ."</td>";
                echo "<td>". $json['data'][$i]['stationFrom']['stationName'] ."</td>";
                echo "<td>". $json['data'][$i]['stationTo']['stationName'] ."</td>";
                echo "<td>". $json['data'][$i]['departureTime'] ."</td>";
                echo "<td>". $json['data'][$i]['arrivalTime'] ."</td>";
                echo "<td>". $json['data'][$i]['duration'] ."</td></tr>";
                $i++;
            }
            echo "</table>";

            // Calculate estimated time of arrival
            $distance = $json['data'][0]['distance'];
            $speed = $json['data'][0]['avgSpeed'];

            $expectedTimeOfArrival = $distance/$speed;

            $hours = floor($expectedTimeOfArrival); 
            $minutes = ( $expectedTimeOfArrival - $hours) * 60; 

            echo "Estimated time of arrival is ". $hours . " hours and " . round($minutes) . " minutes from Time of Depature.";
        
            

        ?>
        
    </body>
</html>