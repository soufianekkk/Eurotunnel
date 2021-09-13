<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getlink</title>
</head>
<body>
    
    <?php
        


        // Variable declarations
        
        
        $dirname = './SimplonBoulogne/Json/';
        
        
        // Open directory
        
        
        $dir = opendir($dirname);
        
        
        // Get each file in directory
        
        
        while ($file = readdir($dir)) {
        
        
            // Get file with json extension
        
        
            if (pathinfo($dirname.$file)['extension'] == 'json') {
        
        
                // Variable declarations
        
        
                $jsonString = file_get_contents($dirname.$file);
                $data = json_decode($jsonString, true);
                $result = [$data['PERNR'],$data['ObjectSID'],$data['Current_Step']['Name']];
        
        
                // Print_r before encode
        
        
                print_r($result);
                echo '<br><br>';
        
        
                // Print_r after encode
        
        
                print_r(json_encode($result));
                echo '<br><br>';
        
        
                // Creation of context options
        
        
                $options = array(
                    'http' => array(
                        'method'  => 'POST',
                        'header'  => "Content-Type: application/json",
                        'ignore_errors' => true,
                        'timeout' =>  10,
                        'content' => json_encode($result),
                    ),
                );
                
                // Creation of context HTTP
        
        
                $context  = stream_context_create($options);
                
                // Execution of the request
        
        
                file_get_contents('http://localhost:5000/api/v1/ITAccount', false, $context);
        
        
            }
        
        
        }
        
        
        // Close directory
        
        
        closedir($dir);
        
        
    ?>
</body>
</html>