<?php

class Dreamhost {
	
	private $key;
	
	function __construct($key) {
		$this->key = $key;
	}
	
	function __call($cmd, $args) {
		return $this->exec($cmd, $args);
	}
	
	function exec($cmd, $args = Array()) {
		$args['cmd'] = $cmd;
		$args['key'] = $this->key;
		$args['format'] = 'json';
		
		$ch = curl_init('https://api.dreamhost.com');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		$errno = curl_errno($ch);
		curl_close($ch);
		
		if (!$result) {
			throw new Exception($error, $errno);
		}
		
		$data = json_decode($result, 1);
		
		if (!$data) {
			throw new Exception('JSON parse error on: ' . $result);
		}
		
		if ($data['result'] === 'error') {
			throw new Exception($data['data']);
		} else {
			return $data['data'];
		}
	}
	
}