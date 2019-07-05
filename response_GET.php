<?php
	
    $trigger_channel = $_GET['triggerchannel'];
    $action_channel = $_GET['actionchannel'];
    $response;

    $servername = "localhost";
    $username = "nome_utente";
    $password = "password";
    $dbname = "nomeDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT activate FROM `avj3_chronoforms_data_behavior` WHERE triggerchannel =".$trigger_channel."AND actionchannel =" .$action_channel;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $response = $row['activate'];
        }
        
    } else {
        //echo "0 results";
    }

        
    $conn->close();

    echo $response;

?>
