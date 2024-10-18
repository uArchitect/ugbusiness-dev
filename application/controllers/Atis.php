<?php

class Atis extends CI_Controller {
	function __construct(){
        parent::__construct();
		
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
        date_default_timezone_set('Europe/Istanbul');
		$this->load->model('Stok_model');
    }

	
	public function atis_kontrol() {
		
	  // JSON formatında veri al
	  $json_data = $this->input->raw_input_stream;

	  // JSON'u diziye dönüştür
	  $data = json_decode($json_data, true);

	  if (isset($data['id'])) {
		  // ID'yi işleyin (örneğin, veritabanına kaydedebilirsiniz)
		  // Burada sadece örnek olarak ekrana yazdırıyoruz
		  $id = $data['id'];
		  // Başarılı yanıt döndür
		 
		  $response = [
			'status' => 'success',
			'message' => 'Atis yapilabilir'
		];
		  echo json_encode($response);
	  } else {
		  // Hatalı yanıt
		  $response = [
			'status' => 'error',
			'message' => 'Atis yapilamaz!'
		];
		  echo json_encode($response);
	  }
    }

 
	
	}
 