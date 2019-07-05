<?php
	header("Content-Type: application/json");
    $json_input = json_decode(file_get_contents('php://input'), false);

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

    function check_trigger($trigger, $conn){
        
        $sql = "SELECT `avj3_chronoforms_data_connector`.name AS connectorName, `avj3_chronoforms_data_connector`.description AS connectorDescr, `avj3_chronoforms_data_triggerchannel`.name AS triggerName, `avj3_chronoforms_data_triggerchannel`.description AS triggerDescr\n"
            . "FROM `avj3_chronoforms_data_connector`\n"
                . "INNER JOIN `avj3_chronoforms_data_triggerchannel`\n"
                    . "ON `avj3_chronoforms_data_connector`.aid = `avj3_chronoforms_data_triggerchannel`.connectorID && `avj3_chronoforms_data_connector`.name = \"".$trigger."\"";

        $result = $conn->query($sql);
        $response = "Mi dispiace ma non sono capace di rilevare il tue evento.";

        if ($result->num_rows > 0) {
            if($result->num_rows != 1)
                $response = "Bene, l'evento da te scelto puo' essere rilevato con una delle seguenti opzioni: ";
            else
                $response = "Bene, l'evento da te scelto puo' essere rilevato solo con la seguente opzione: ";

            while($row = $result->fetch_assoc()) {
            
                $response = $response.$row['triggerDescr']."; ";
            }

            if($result->num_rows != 1)
                $response = $response."quale scegli?";
            else
                $response = $response."puoi riscrivere questa unica opzione per confermare l'eveno da rilevare?";

        } else {
            //echo "0 results";
        }

    	return $response;
    }

    function check_trigger_channel($trigger, $trigger_channel){
    	return "Ora, mi puoi dire il dispositivo o il servizio da attivare dopo aver rilevato l'evento?";
    }
    
    function check_action($action, $conn){
        $sql = "SELECT `avj3_chronoforms_data_connector`.name AS connectorName, `avj3_chronoforms_data_connector`.description AS connectorDescr, `avj3_chronoforms_data_actionchannel`.name AS actionName, `avj3_chronoforms_data_actionchannel`.description AS actionDescr\n"
            . "FROM `avj3_chronoforms_data_connector`\n"
                . "INNER JOIN `avj3_chronoforms_data_actionchannel`\n"
                    . "ON `avj3_chronoforms_data_connector`.aid = `avj3_chronoforms_data_actionchannel`.connectorID && `avj3_chronoforms_data_connector`.name = \"".$action."\"";

        $result = $conn->query($sql);
        $response = "Mi dispiace ma non sono capace di eseguire nessuna azione con la tua scelta.";

        if ($result->num_rows > 0) {
            if($result->num_rows != 1)
                $response = "Con la tua scelta puoi compiere le seguenti azioni: ";
            else
                $response = "Con la tua scelta puoi compiere solo la seguente azione: ";

            while($row = $result->fetch_assoc()) {
                $response = $response.$row['actionDescr'].", ";
            }
            
            if($result->num_rows != 1)
                $response = $response."quale azione vuoi attivare?";
            else
                $response = $response."puoi riscrivere questa unica opzione per confermare l'azione da eseguire?";

        } else {
            //echo "0 results";
        }

    	return $response;
    }

    function getTriggerChannelDescr($trigger_channel, $conn){
        $response;

        $sql = "SELECT `avj3_chronoforms_data_triggerchannel`.name AS triggerName, `avj3_chronoforms_data_triggerchannel`.description AS triggerDescr\n"
            . "FROM `avj3_chronoforms_data_triggerchannel`\n"
                . "WHERE `avj3_chronoforms_data_triggerchannel`.name = \"".$trigger_channel."\"";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $response = $row['triggerDescr'];
            }

        } else {
            //echo "0 results";
        }

        return $response;
    }

    function getActionChannelDescr($action_channel, $conn){
        $response;

        $sql = "SELECT `avj3_chronoforms_data_actionchannel`.name AS actionName, `avj3_chronoforms_data_actionchannel`.description AS actionDescr\n"
            . "FROM `avj3_chronoforms_data_actionchannel`\n"
                . "WHERE `avj3_chronoforms_data_actionchannel`.name = \"".$action_channel."\"";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $response = $row['actionDescr'];
            }

        } else {
            //echo "0 results";
        }

        return $response;

    }

    function check_action_channel($action, $action_channel, $trigger, $trigger_channel, $conn){
        $triggerchannel = getTriggerChannelDescr($trigger_channel, $conn);
        $actionChannel = getActionChannelDescr($action_channel, $conn);

        return "Ok. hai composto la seguente automazione: ".$triggerchannel.", ".$actionChannel.". Confermi?";
    
    }

    function check_free_rule($trigger_channel, $action_channel, $conn){
        $triggerchannel = getTriggerChannelDescr($trigger_channel, $conn);
        $actionChannel = getActionChannelDescr($action_channel, $conn);
        $result;

        if($actionChannel != "")
            $result = "Ok. hai composto la seguente automazione: ".$triggerchannel.", ".$actionChannel.". Confermi?"; 
        else
            $result = "Bene, stai per comporre una nuova automazione. confermi?";

        return $result;
    
    }
    
    function processing_rule($action, $action_channel, $trigger, $trigger_channel, $conn){
        $time = time(); 
        $date = date("Y-m-d h:i:s",$time);

        $sql_for_count = "SELECT * FROM `avj3_chronoforms_data_behavior`";

        $result = $conn->query($sql_for_count);
        
        $aid = $result->num_rows + 1;
        $user_id = 000;
        $created = $date;
        $triggerchannel = $trigger_channel;
        $actionchannel = $action_channel;

        $sql = "INSERT INTO `avj3_chronoforms_data_behavior`(`aid`, `user_id`, `created`, `modified`, `triggerchannel`, `actionchannel`, `activate`) 
                    VALUES (".$aid.",".$user_id.",\"".$created."\",NULL,\"".$triggerchannel."\",\"".$actionchannel."\",\"true\")";
        
        $result = $conn->query($sql);

    	return "Ottimo, ora la tua automazione è stata attivata. Posso aiutarti a creare una nuova automazione oppure abbiamo terminato?";
    }

    function processing_free_rule($trigger_channel, $action_channel, $conn){
        $time = time(); 
        $date = date("Y-m-d h:i:s",$time);

        $sql_for_count = "SELECT * FROM `avj3_chronoforms_data_behavior`";

        $result = $conn->query($sql_for_count);
        
        $aid = $result->num_rows + 1;
        $user_id = 000;
        $created = $date;
        $triggerchannel = $trigger_channel;
        $actionchannel = $action_channel;

        $sql = "INSERT INTO `avj3_chronoforms_data_behavior`(`aid`, `user_id`, `created`, `modified`, `triggerchannel`, `actionchannel`, `activate`) 
                    VALUES (".$aid.",".$user_id.",\"".$created."\",NULL,\"".$triggerchannel."\",\"".$actionchannel."\",\"true\")";
        
        $result = $conn->query($sql);

    	return "Ottimo, ora la tua automazione è stata attivata. Posso aiutarti a creare una nuova automazione oppure abbiamo terminato?";
    }
     
    function trigger_viewer($conn){
        $user_id = 000;
        
        $sql = "SELECT * FROM `avj3_chronoforms_data_connector` WHERE user_id =".$user_id;

        $result = $conn->query($sql);
        $response = "Mi dispiace ma non ho trovato servizi da rilevare.";

        if ($result->num_rows > 0) {
            $response = "Gli eventi che possono essere rilevati sono i seguenti:  ";
           
            while($row = $result->fetch_assoc()) {
                if($row['trigger'] == 1)
                    $response = $response.$row['description']."; ";
            }
        } else {
            //echo "0 results";
        }

    	return $response;
    }


    function action_viewer($conn){
        $user_id = 000;
        
        $sql = "SELECT * FROM `avj3_chronoforms_data_connector` WHERE user_id =".$user_id;

        $result = $conn->query($sql);
        $response = "Mi dispiace ma non ho trovato servizi da attivare.";

        if ($result->num_rows > 0) {
            $response = "mentre le azioni che possono essere eseguite, dopo aver rilevato uno dei precedenti eventi, sono:  ";
           
            while($row = $result->fetch_assoc()) {
                if($row['action'] == 1)
                    $response = $response.$row['description']."; ";
            }

        } else {
            //echo "0 results";
        }

    	return $response;
    }





    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    $response = "null";
    
    if($json_input->queryResult->action == "DefaultWelcomeIntent.DefaultWelcomeIntent-custom"){
    	$response = trigger_viewer($conn).action_viewer($conn)."per realizzare la tua automazione, come vuoi procedere in modalità GUIDATA o LIBERA?";
    }

    if($json_input->queryResult->action == "check_trigger"){
    	$response = check_trigger($json_input->queryResult->parameters->trigger, $conn);
    }

    if($json_input->queryResult->action == "check_trigger_channel"){
    	$response = check_trigger_channel($json_input->queryResult->parameters->trigger, $json_input->queryResult->parameters->triggerChannel);
    }
    
    if($json_input->queryResult->action == "check_action"){
    	$response = check_action($json_input->queryResult->parameters->action, $conn);
    }

    if($json_input->queryResult->action == "check_action_channel"){
    	$response = check_action_channel($json_input->queryResult->parameters->action, $json_input->queryResult->parameters->actionChannel, $json_input->queryResult->parameters->trigger, $json_input->queryResult->parameters->triggerChannel, $conn);
    }

    if($json_input->queryResult->action == "check_free_rule"){
        $response = check_free_rule($json_input->queryResult->parameters->triggerChannel, $json_input->queryResult->parameters->actionChannel, $conn);
    }
    
    if($json_input->queryResult->action == "processing_rule"){
    	$response = processing_rule($json_input->queryResult->parameters->action, $json_input->queryResult->parameters->actionChannel, $json_input->queryResult->parameters->trigger, $json_input->queryResult->parameters->triggerChannel, $conn);
    }

    if($json_input->queryResult->action == "processing_free_rule"){
        
        //Controlla se non sono state inserite due actionChannel
        if($json_input->queryResult->parameters->addActionChannel == "#processingFreeRule.addActionChannel.action-channel #processingFreeRule.addActionChannel.action-channel")
        	$response = processing_free_rule($json_input->queryResult->parameters->triggerChannel, $json_input->queryResult->parameters->actionChannel, $conn);
        else{
                //Da DialogFlow arriva una stringa con sottostringa ripetuta, pertanto si explode la stringa in tre sottostringhe separandole tramite la congiunzione "e"
                //  preceduta e seguita dagli spazi: " e ", così facendo viene considerata solo "e" congiunzione, trascurando le altre.
        	    $addActionChannelSubStr = explode(" e ", $json_input->queryResult->parameters->addActionChannel, 3);
                
                //Necessarie per generare due regole secondo la logica di progettazione, ossia: 
                //  un triggerChannel + due actionChannel produce due regole triggerChannel-actionChannel 
                $actionChannel_1 = $addActionChannelSubStr[0];
                $actionChannel_2 = $addActionChannelSubStr[2];
                
                $response = processing_free_rule($json_input->queryResult->parameters->triggerChannel, $actionChannel_1, $conn);
                $response = processing_free_rule($json_input->queryResult->parameters->triggerChannel, $actionChannel_2, $conn);
        }
    }
    
    $conn->close();
    $json_output->fulfillmentText = $response;
    echo json_encode($json_output);
   
 ?>
