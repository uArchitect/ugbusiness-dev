<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Netgsm extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ayar_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function santral()
	{     
        yetki_kontrol("netgsm_santral_kayit_goruntule"); 

        function curlitjson($url,$content) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);				
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);				
        return($json_response);
        }
        
        try {
           
            date_default_timezone_set('Europe/Istanbul');
            $one_day_before = strtotime(date("Y-m-d"));
            $start_date = date('dmY0000', $one_day_before); 
           
            $ayar = $this->Ayar_model->get_by_id(1); 
            $arr_acc = array('usercode' => $ayar[0]->netgsm_kullanici_ad, 'password' => base64_decode($ayar[0]->netgsm_kullanici_sifre), 'startdate' => $start_date, 'stopdate' => $end_date);				
            $url_acc = "https://api.netgsm.com.tr/netsantral/report";  
            $content_acc = json_encode($arr_acc);				  
            $send_acc = curlitjson($url_acc,$content_acc);
            $send_acc = json_decode($send_acc,true);
            $viewData["santral_kayitlar"] = $send_acc;
        } catch (Exception $exc)
          {  
          echo $exc->getMessage();
        }






        
        $viewData["page"] = "netgsm/santral";
		$this->load->view('base_view',$viewData);
	}
 
}
