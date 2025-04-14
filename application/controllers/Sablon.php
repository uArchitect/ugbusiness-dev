<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sablon extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($id)
	{
        
        $viewData["secilen_kategori"] = $this->db->where("sablon_kategori_id",$id)->get("sablon_kategoriler")->result()[0];
            
        $viewData["sablonlar"] = $this->db->get("sablon_kategoriler")->result();


        $viewData["veriler"] = $this->db->where("sablon_veri_kategori_id",$id)->get("sablon_veriler")->result();



		$viewData["page"] = "sablon";
		$this->load->view('base_view',$viewData);
	} public function sablon_veri_sil($sablon_veri_id)
	{
       
        $this->db->where("sablon_veri_id",$sablon_veri_id)->delete("sablon_veriler");
        redirect($_SERVER['HTTP_REFERER']); 
	} 
 public function sablon_kategori_sil($sablon_kategori_id)
	{
       
        $this->db->where("sablon_kategori_id",$sablon_kategori_id)->delete("sablon_kategoriler");
        redirect($_SERVER['HTTP_REFERER']); 
	}  
        
        
        public function yeni_sablon_kategori_ekle()
	{
       
        $insertData["sablon_kategori_adi"]     = $this->input->post("sablon_kategori_adi");
        $this->db->insert("sablon_kategoriler",$insertData);
        redirect($_SERVER['HTTP_REFERER']); 
	} 
	 public function sablon_veri_ekle($sablon_kategori_id)
	{
        $insertData["sablon_veri_kategori_id"] = $sablon_kategori_id;
        $insertData["sablon_veri_adi"]     = $this->input->post("sablon_veri_adi");
        $this->db->insert("sablon_veriler",$insertData);
        redirect($_SERVER['HTTP_REFERER']); 
	} 
     public function sablon_kategori_guncelle($sablon_kategori_id)
	{
        $updateData["sablon_kategori_adi"] = $this->input->post("sablon_kategori_adi");
        $this->db->where("sablon_kategori_id",$sablon_kategori_id)->update("sablon_kategoriler",$updateData);
        redirect($_SERVER['HTTP_REFERER']); 
	}

public function sablon_detay_guncelle($sablon_kategori_id)
	{
        $updateData["sablon_kategori_detay"] = $this->input->post("sablon_kategori_detay");
        $this->db->where("sablon_kategori_id",$sablon_kategori_id)->update("sablon_kategoriler",$updateData);
        redirect($_SERVER['HTTP_REFERER']); 
	}


        
        public function sablon_veri_guncelle($sablon_veri_id)
        {
            $updateData["sablon_veri_adi"] = $this->input->post("sablon_veri_adi");
        
            // Bu örnekte sadece adı güncelliyoruz ama istersen detay da alabilirsin
            $this->db->where("sablon_veri_id", $sablon_veri_id)->update("sablon_veriler", $updateData);
        
            echo "ok"; // redirect gerekmez çünkü fetch kullanıyoruz
        }
        
}
