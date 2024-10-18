<?php

class Atis extends CI_Controller {
	function __construct(){
        parent::__construct();
		 
        date_default_timezone_set('Europe/Istanbul');
	 
    }

	
	public function atis_kontrol() {
	  $json_data = $this->input->raw_input_stream;
	  $data = json_decode($json_data, true);
	  if (isset($data['data_id'])) {
		  $id = $data['data_id']; 
		  echo 1;
	  } else { 
		  echo 1;
	  }
    }
}
 