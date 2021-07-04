<?php
class Curl {
	
	public function __construct(){

	}

	public function get($url, $headers){
				
		$ch = curl_init($url);          
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                        
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                    
		$result = curl_exec($ch);
		return json_decode($result);
	}

	public function post($url, $data_string, $header = null, $type = 'application/json'){
		
		$headers = array(                                                                          
		    'Content-Type: '.$type,                                                                                
		    'Content-Length: ' . strlen(json_encode($data_string)));

		if($header){
			$headers = array_merge($headers, $header);
		}
		
		$ch = curl_init($url);                                                                 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_string));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		$result = curl_exec($ch);

		if (curl_errno($ch)) {
			return array('ERROR: ' => curl_error($ch));
		    
		}
		  
		return json_decode($result);
	}

	public function put($url, $data_string, $header = null){

		$headers = array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string));

		$headers = array_merge($headers, $header);

		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
		curl_setopt($ch, CURLOPT_FAILONERROR, true);                                                                    
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);                                                                                                                   
		 
		$result = curl_exec($ch);
		return $result;
	}

	public function delete($url, $data_string, $header = null){
		$headers = array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string));

		$headers = array_merge($headers, $header);

		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
		curl_setopt($ch, CURLOPT_FAILONERROR, true);                                                                    
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                                                                                                                   
		 
		$result = curl_exec($ch);
		return $result;
	}
}