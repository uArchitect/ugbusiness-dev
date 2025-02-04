<?php

class Onemli_gun extends CI_Controller {
	function __construct(){
        parent::__construct();
		 
        date_default_timezone_set('Europe/Istanbul');
	 yetki_kontrol("onemli_gun_yonetimi");
    }
    public function delete_etkinlik($onemli_gun_id = 0) {

        if($onemli_gun_id != 0){
            $this->db->where("onemli_gun_id",$onemli_gun_id)->delete("onemli_gunler");
        }
        

        redirect(base_url("onemli_gun/index_etkinlik"));
    }

    public function delete_gun($onemli_gun_id = 0) {

        if($onemli_gun_id != 0){
            $this->db->where("onemli_gun_id",$onemli_gun_id)->delete("onemli_gunler");
        }
        

        redirect(base_url("onemli_gun"));
    }

	public function index_etkinlik() {
        $viewData["onemli_gunler"] = $this->db->where("etkinlik_mi",1)->order_by("onemli_gun_tarih","asc")->get("onemli_gunler")->result();
	   $viewData["page"] = "yaklasan_etkinlik";
	   $this->load->view("base_view",$viewData);
    }
	public function index() {
        $viewData["onemli_gunler"] = $this->db->order_by("onemli_gun_tarih","asc")->get("onemli_gunler")->result();
	   $viewData["page"] = "onemli_gun";
	   $this->load->view("base_view",$viewData);
    }
    public function save() {
        $insertData["onemli_gun_adi"] = $this->input->post("onemli_gun_adi"); 
        $insertData["onemli_gun_tarih"] = $this->input->post("onemli_gun_tarih");
        $insertData["onemli_gun_tarih_uzun"] = $this->input->post("onemli_gun_tarih_uzun");
        $this->db->insert("onemli_gunler", $insertData);
        redirect(base_url("onemli_gun"));
    }
    public function etkinlik_save() {
        $insertData["etkinlik_mi"] = 1; 
        $insertData["onemli_gun_adi"] = $this->input->post("onemli_gun_adi"); 
        $insertData["onemli_gun_tarih"] = $this->input->post("onemli_gun_tarih");
        $insertData["onemli_gun_tarih_uzun"] = $this->input->post("onemli_gun_tarih_uzun");
        $this->db->insert("onemli_gunler", $insertData);
        redirect(base_url("onemli_gun/index_etkinlik"));
    }
    public function gun_tamamlandi_etkinlik($gun_id) {
        $this->db->where("onemli_gun_id",$gun_id)->update("onemli_gunler",["onemli_gun_tamamlandi"=>1]);
     redirect(base_url("onemli_gun/index_etkinlik"));
  }
  public function gun_beklemede_etkinlik($gun_id) {
      $this->db->where("onemli_gun_id",$gun_id)->update("onemli_gunler",["onemli_gun_tamamlandi"=>0]);
      redirect(base_url("onemli_gun/index_etkinlik"));
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
 