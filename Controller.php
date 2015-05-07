public function bloquear($id, $message) {

    	$disp = Dispositivo::find($id);
    	$regids = $disp->RegistroGCM;

        $fields = array(
            'registration_ids'	=> array($regids),
            'data' 				=> array('message' 	=> $message,
            							  'id' 	=> $id)
        );
        
        $url = 'https://android.googleapis.com/gcm/send';
 
        $headers = array(
            'Authorization: key=YOUR-GCM-KEY',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return Response::json(array('error' => 'ERROR. THE REQUEST FAILED'));
        }
 
        // Close connection
        curl_close($ch);
        
        $respuesta = json_decode($result, true);

        try {
        	if($respuesta["error"]){
	        	return Response::json(array('error' => 'ERROR. THE REQUEST FAILED'));
	        } else {
	        	return Response::json(array('message' => 'OK !!'));
	        }
        	
        } catch (Exception $e) {
        	return Response::json(array('error' => 'ERROR. THE REQUEST FAILED'));
        }

    }
