<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api2 extends CI_Controller {
	function __construct(){
        parent::__construct();	
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        date_default_timezone_set('Europe/Istanbul');
    }

	public function test()
	{
		$method = strtoupper($_SERVER['REQUEST_METHOD']);
		$input_data = null;
		
		if ($method == 'POST' || $method == 'PUT') {
			$json = file_get_contents('php://input');
			$input_data = json_decode($json, true);
			if ($input_data === null && !empty($json)) {
				parse_str($json, $input_data);
			}
		} else {
			$input_data = $this->input->get();
		}

		$response = [
			'status' => 'success',
			'message' => 'API2 test endpoint çalışıyor!',
			'timestamp' => date('Y-m-d H:i:s'),
			'method' => $method,
			'input_data' => $input_data,
			'server_info' => [
				'php_version' => phpversion(),
				'server_time' => date('Y-m-d H:i:s'),
				'timezone' => date_default_timezone_get()
			]
		];

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
}

