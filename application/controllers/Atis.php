<?php

class Atis extends CI_Controller {
	function __construct(){
        parent::__construct();
		 $this->load->model('Atis_log_model');  
        $this->load->helper('url');  
        date_default_timezone_set('Europe/Istanbul');
	 
    }

 

public function get_atis_data($filter = 1) {
    
      $baslangicTarihZaman = ""; // Y-m-d 00:00
    $bitisTarihZaman = ""; // Y-m-d 23:59
    if ($filter == 1) { // Bugün 
    $baslangicTarihZaman = (new DateTime())->format('Y-m-d 00:00');
    $bitisTarihZaman = (new DateTime())->format('Y-m-d 23:59');
} elseif ($filter == 2) { // Dün 
    $baslangicTarihZaman = (new DateTime('yesterday'))->format('Y-m-d 00:00');
    $bitisTarihZaman = (new DateTime('yesterday'))->format('Y-m-d 23:59');
} elseif ($filter == 3) { // Son 3 Gün 
    $baslangicTarihZaman = (new DateTime('-2 days'))->format('Y-m-d 00:00');
    $bitisTarihZaman = (new DateTime())->format('Y-m-d 23:59');
} elseif ($filter == 4) { // Bu Hafta 
    $baslangicTarihZaman = (new DateTime('this week monday 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('this week sunday 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 5) { // Bu Ay 
    $baslangicTarihZaman = (new DateTime('first day of this month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of this month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 6) { // Geçen Ay 
    $baslangicTarihZaman = (new DateTime('first day of last month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of last month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 7) { // Son 3 Ay 
    $baslangicTarihZaman = (new DateTime('-2 months first day of this month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of this month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 8) { // Son 6 Ay
    $baslangicTarihZaman = (new DateTime('-5 months first day of this month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of this month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 9) { // Bu Yıl 
    $baslangicTarihZaman = (new DateTime('first day of january this year 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of december this year 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 10) { // Geçen Yıl
    $baslangicTarihZaman = (new DateTime('first day of january last year 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of december last year 23:59'))->format('Y-m-d H:i');
}
 
elseif ($filter == 11) {  
 
    $baslangicTarihZaman = (new DateTime('2025-07-31 00:00:00'))->format('Y-m-d H:i');

  
     $bitisTarihZaman = (new DateTime())->format('Y-m-d 23:59');
}
    $this->db->where("islem_tarihi >=",$baslangicTarihZaman)->where("islem_tarihi <=",$bitisTarihZaman);
    $logs = $this->Atis_log_model->get_all_logs();

   
    $success_count = 0;
    $failure_count = 0;
    $beklemede_count = 0;
    $unique_serial_numbers = [];
    $ozel_count = 0;
    $umexlazeratis = 0;
    $umexplusatis = 0;
    $digeratis = 0;

    $uretimatis = 0;
      $musteriatis = 0;
    
    foreach ($logs as $log) {
        if ($log->atis_yukleme_basarili_mi == 1) {
            $success_count++;
        } else if ($log->atis_yukleme_basarili_mi == 2) {
            $failure_count++;
        } 
        else {
            $beklemede_count++;
        }

        if($log->tablet_no == 1){
            $uretimatis++;
        }else{
            $musteriatis++;
        }




        if ($log->ozel_gecis_kodu != "0") {
            $ozel_count++;
        }

        if (strpos($log->seri_no, 'UP01') !== false) {  
            $umexplusatis++;
        } else if (strpos($log->seri_no, 'UX01') !== false) {
            $umexlazeratis++;
        } else {
            $digeratis++;
        }

        $unique_serial_numbers[$log->seri_no] = true;
    }

    $data = [
        'logs' => $logs,
        'umexlazeratis' => $umexlazeratis,
        'digeratis' => $digeratis,
        'umexplusatis' => $umexplusatis,
        'total_ozel_logs' => $ozel_count,
        'success_count' => $success_count,
        'beklemede_count' => $beklemede_count,
        'failure_count' => $failure_count,
        'uretim_atis' => $uretimatis,
        'musteri_atis' => $musteriatis,
        'total_logs' => count($logs),
        'unique_serial_number_count' => count($unique_serial_numbers)
    ];

 
    header('Content-Type: application/json');
    echo json_encode($data);
}


  public function index($filter = 1) {
        
    if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 7 || $this->session->userdata('aktif_kullanici_id') == 9){
			 
		



    $baslangicTarihZaman = ""; // Y-m-d 00:00
    $bitisTarihZaman = ""; // Y-m-d 23:59
 
    if(!empty($this->input->post("baslangic_date")) && !empty($this->input->post("bitis_date"))){
         $data['filter'] = 0;
        $baslangicTarihZaman = date("Y-m-d 00:00",strtotime($this->input->post("baslangic_date")));
        $bitisTarihZaman = date("Y-m-d 23:59",strtotime($this->input->post("bitis_date")));
    } else{
        
 $data['filter'] = $filter;

    if ($filter == 1) { // Bugün 
    $baslangicTarihZaman = (new DateTime())->format('Y-m-d 00:00');
    $bitisTarihZaman = (new DateTime())->format('Y-m-d 23:59');
} elseif ($filter == 2) { // Dün 
    $baslangicTarihZaman = (new DateTime('yesterday'))->format('Y-m-d 00:00');
    $bitisTarihZaman = (new DateTime('yesterday'))->format('Y-m-d 23:59');
} elseif ($filter == 3) { // Son 3 Gün 
    $baslangicTarihZaman = (new DateTime('-2 days'))->format('Y-m-d 00:00');
    $bitisTarihZaman = (new DateTime())->format('Y-m-d 23:59');
} elseif ($filter == 4) { // Bu Hafta 
    $baslangicTarihZaman = (new DateTime('this week monday 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('this week sunday 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 5) { // Bu Ay 
    $baslangicTarihZaman = (new DateTime('first day of this month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of this month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 6) { // Geçen Ay 
    $baslangicTarihZaman = (new DateTime('first day of last month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of last month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 7) { // Son 3 Ay 
    $baslangicTarihZaman = (new DateTime('-2 months first day of this month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of this month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 8) { // Son 6 Ay
    $baslangicTarihZaman = (new DateTime('-5 months first day of this month 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of this month 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 9) { // Bu Yıl 
    $baslangicTarihZaman = (new DateTime('first day of january this year 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of december this year 23:59'))->format('Y-m-d H:i');
} elseif ($filter == 10) { // Geçen Yıl
    $baslangicTarihZaman = (new DateTime('first day of january last year 00:00'))->format('Y-m-d H:i');
    $bitisTarihZaman = (new DateTime('last day of december last year 23:59'))->format('Y-m-d H:i');
}
elseif ($filter == 11) {  
    
    $baslangicTarihZaman = (new DateTime('2025-07-31 00:00:00'))->format('Y-m-d H:i');

    
     $bitisTarihZaman = (new DateTime())->format('Y-m-d 23:59');
}

    }
      

    $this->db->where("islem_tarihi >=",$baslangicTarihZaman)->where("islem_tarihi <=",$bitisTarihZaman);
        $data['logs'] = $this->Atis_log_model->get_all_logs();

     
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
        
        $data['baslangicTarihZaman'] = $baslangicTarihZaman;
        $data['bitisTarihZaman'] = $bitisTarihZaman;

        // Load the view with data
        $this->load->view('base_view', $data);
    }}


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
 