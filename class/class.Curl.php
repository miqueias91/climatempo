<?php
class Curl {
	
	public function __construct(){
	}

	public function get($url, $headers = array('Content-Type: application/json')){
		$ch = curl_init($url);          
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                            
		$result = curl_exec($ch);
		return json_decode($result,true);
	}
}