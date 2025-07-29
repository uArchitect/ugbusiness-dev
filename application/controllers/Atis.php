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
        $unique_serial_numbers = [];

        foreach ($data['logs'] as $log) {
            if ($log->atis_yukleme_basarili_mi == 1) {
                $success_count++;
            } else {
                $failure_count++;
            }
            $unique_serial_numbers[$log->seri_no] = true;
        }

        $data['success_count'] = $success_count;
        $data['failure_count'] = $failure_count;
        $data['total_logs'] = count($data['logs']);
        $data['unique_serial_number_count'] = count($unique_serial_numbers);

        // Load the view with data
        $this->load->view('atis_log_view', $data);
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
 