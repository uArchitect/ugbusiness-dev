<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yazilim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function index()
	{     

        if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9){
            $this->db->order_by("sira", "ASC");

            $viewData["data"] = $this->db->get("yazilim")->result();
            $viewData["page"] = "yazilim/list";
            $this->load->view('base_view',$viewData);
        }else{
            echo redirect("anasayfa");
        }
       
	}
public function sirala() {
    $order = $this->input->post("order");
    foreach ($order as $i => $id) {
        $this->db->where("yazilim_id", $id)->update("yazilim", ["sira" => $i]);
    }
}


    public function tamamla($id)
{


    $c = $this->db->where("yazilim_id", $id)->get("yazilim")->row();
    sendSmsData("05468311015",$c->yazilim_detay." işi tamamlanmıştır. (".date("d.m.Y H:i").")\n\n");
    sendSmsData("05382197344",$c->yazilim_detay." işi tamamlanmıştır. (".date("d.m.Y H:i").")\n\n");
    
	 

    $this->db->where("yazilim_id", $id)->update("yazilim", ["tamamlandi_mi" => 1]);
    redirect(base_url("yazilim"));
}  public function bekleme($id)
{
    $this->db->where("yazilim_id", $id)->update("yazilim", ["tamamlandi_mi" => 0]);
    redirect(base_url("yazilim"));
}

public function sil($id)
{
    $this->db->where("yazilim_id", $id)->delete("yazilim");
    redirect(base_url("yazilim"));
}

public function duzenle($id)
{
    $data["veri"] = $this->db->where("yazilim_id", $id)->get("yazilim")->row();
    $data["page"] = "yazilim/duzenle";
    $this->load->view("base_view", $data);
}

public function guncelle($id)
{
    $this->db->where("yazilim_id", $id)->update("yazilim", [
        "yazilim_detay" => $this->input->post("yazilim_detay"),
        "kullanici_ad_soyad" => $this->input->post("kullanici_ad_soyad"),
    ]);
    redirect(base_url("yazilim"));
}

public function ekle() {


   	


    // En büyük sira değerini al
    $son_sira = $this->db->select_max('sira')->get('yazilim')->row()->sira;
    $yeni_sira = ($son_sira !== null) ? $son_sira + 1 : 1;

    $data = array(
        'yazilim_detay'      => $this->input->post('yazilim_detay'),
        'kullanici_ad_soyad' => aktif_kullanici()->kullanici_ad_soyad,
        'tamamlandi_mi'      => 0,
        'kayit_tarihi'       => date("Y-m-d H:i:s"),
        'sira'               => $yeni_sira
    );

    $this->db->insert('yazilim', $data);

    sendSmsData("05468311015","Yapılacak İşler Listesine Yeni Kayıt Eklendi (".date("d.m.Y H:i").")\n\n".$this->input->post('yazilim_detay'));
	sendSmsData("05382197344","Yapılacak İşler Listesine Yeni Kayıt Eklendi (".date("d.m.Y H:i").")\n\n".$this->input->post('yazilim_detay'));
	

    redirect('yazilim');
}

    
}
