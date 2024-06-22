<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman_inceleme extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Dokuman_inceleme_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function delete($dokuman_id,$id)
	{     
        yetki_kontrol("gozden_gecirme_sil");
		$this->Dokuman_inceleme_model->delete($id);  
        $viewData["page"] = "dokuman/duzenle/$dokuman_id";
		$this->load->view('base_view',$viewData);
	}
}
