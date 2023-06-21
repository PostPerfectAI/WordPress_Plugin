<?php

class AIP_API {
	
	public static function SIGN($data) {
		$json = json_encode($data,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		$key = get_option("aip_api_key","");
		$hashstr = $json.":".$key;
		return hash("sha256",$hashstr);
	}
	
	public static function CALL($endpoint,$data) {
		$ch = curl_init($endpoint);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		$result = curl_exec($ch);
		error_log($result);
		if ($result === false) {
			$cerror = curl_error($ch);
			curl_close($ch);
			throw new Exception($cerror);
		}
		curl_close($ch);
		return json_decode($result);
	}
	
}