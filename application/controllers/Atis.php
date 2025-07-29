<?php

class Atis extends CI_Controller {
	function __construct(){
        parent::__construct();
		 $this->load->model('Atis_log_model'); // Load your model
        $this->load->helper('url'); // Load URL helper for base_url()
        date_default_timezone_set('Europe/Istanbul');
	 
    }

	
  public function index() {
        // Fetch all log data
        $data['logs'] = $this->Atis_log_model->get_all_logs();

        // Prepare data for statistics
        $success_count = 0;
        $failure_count = 0;

 $beklemede_count = 0;

        
        $unique_serial_numbers = [];
        $ozel_count = 0;

        $umexlazeratis = 0; 
        $umexplus = 0;
        $diger = 0;  
        foreach ($data['logs'] as $log) {
            if ($log->atis_yukleme_basarili_mi == 1) {
                $success_count++;
            } else if($log->atis_yukleme_basarili_mi == 2) {
                $failure_count++;
            }else{
                $beklemede_count++;
            }

			if ($log->ozel_gecis_kodu != "0") {
               $ozel_count++;
            } 
            
             

             if(strpos($log->seri_no,'UP01')){
                 $umexplusatis++;
            }else if(strpos($log->seri_no,'UX01')){
                 $umexlazeratis++;
            }else{
                 $digeratis++;
            }


            $unique_serial_numbers[$log->seri_no] = true;
        }



        $data['umexlazeratis'] = $umexlazeratis;  $data['digeratis'] = $digeratis;  $data['umexplusatis'] = $umexplusatis;
        $data['total_ozel_logs'] = $ozel_count;
        $data['success_count'] = $success_count;
        $data['beklemede_count'] = $beklemede_count;
        $data['failure_count'] = $failure_count;
        $data['total_logs'] = count($data['logs']);
        $data['unique_serial_number_count'] = count($unique_serial_numbers);
        $data['page'] = "atis_log";

        // Load the view with data
        $this->load->view('base_view', $data);
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
 