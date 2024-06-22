<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman_revizyon extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Dokuman_revizyon_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function delete($dokuman_id,$id)
	{     
        yetki_kontrol("dokuman_revizyon_sil");
		$this->Dokuman_revizyon_model->delete($id);  
        $viewData["page"] = "dokuman/duzenle/$dokuman_id";
		$this->load->view('base_view',$viewData);
	}
}
