<?php

class Onemli_gun extends CI_Controller {
	function __construct(){
        parent::__construct();
		 
        date_default_timezone_set('Europe/Istanbul');
	 
    }

	
	public function index() {
        $viewData["onemli_gunler"] = $this->db->order_by("onemli_gun_tarih","asc")->get("onemli_gunler")->result();
	   $viewData["page"] = "onemli_gun";
	   $this->load->view("base_view",$viewData);
    }


    public function gun_tamamlandi($gun_id) {
          $this->db->where("onemli_gun_id",$gun_id)->update("onemli_gunler",["onemli_gun_tamamlandi"=>1]);
	   redirect(base_url("onemli_gun"));
    }
    public function gun_beklemede($gun_id) {
        $this->db->where("onemli_gun_id",$gun_id)->update("onemli_gunler",["onemli_gun_tamamlandi"=>0]);
        redirect(base_url("onemli_gun"));
    }
}
 