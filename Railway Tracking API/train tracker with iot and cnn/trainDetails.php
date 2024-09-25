<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Train API Web Interface</title>
        <link rel="stylesheet" href="./style.css">
        
    </head>
    <body style="padding: 5%; background-image: url(./images/train2.jpeg);">
        <!-- Application header with inline styling -->
        <div class="header" style="padding: 0;height: 40vh; background: none;">
            <h1>TRAIN API</h1>
            <h3>
                A RESTful API to get up to date
                railway information.
            </h3> 
        </div>
            <?php
            
                // Create a variable containing the url to the Train API.
                $url_trainlist = "https://api.railwayapi.site/api/v1/trains?q=126";
                
                // Assign $data the function used to collect data from the url
                $data = file_get_contents($url_trainlist);
                $json = json_decode($data,true);
                
                // Create a table display information gotten from the url
                $i =0;
                echo "<table border=1><tr><td>S.No.</td><td>Train id</td><td>Train Name</td><td>Train Number</td></tr>";
                while(isset($json['data'][$i]['id'])){
                    $num = $i + 1;
                    echo "<tr><td>".$num."</td>";
                    echo "<td>". $json['data'][$i]['id'] ."</td>";
                    echo "<td>". $json['data'][$i]['trainName'] ."</td>";
                    echo "<td>". $json['data'][$i]['trainNumber'] ."</td></tr>";
                    $i++;
                }
                echo "</table>";
            ?>
        
    </body>
</html>
