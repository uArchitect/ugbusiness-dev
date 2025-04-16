<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zimmet extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        
        $data = $this->db->get("zimmet_stoklar")->result();
		$viewData["stoklar"] = $data;



        $this->db->select('
        zs.*,
        zh.*,
        d.*,
        SUM(zh.zimmet_hareket_giris_miktar) AS toplam_giris,
        SUM(zh.zimmet_hareket_cikis_miktar) AS toplam_cikis,
        (SUM(zh.zimmet_hareket_giris_miktar) - SUM(zh.zimmet_hareket_cikis_miktar)) AS kalan
    ');
    $this->db->from('zimmet_hareketler zh');
    $this->db->join('zimmet_stoklar zs', 'zh.zimmet_stok_no = zs.zimmet_stok_id', 'left');
    $this->db->join('zimmet_departmanlar d', 'zh.zimmet_departman_no = d.zimmet_departman_id', 'left');
    $this->db->group_by(['zh.zimmet_stok_no', 'zh.zimmet_departman_no']);
    $this->db->order_by('zs.zimmet_stok_adi', 'ASC');
    $viewData["hareketler"] =  $this->db->get()->result();



    $this->db->select('
    zs.*,
    zh.*,
    d.*  
');
$this->db->from('zimmet_hareketler zh');
$this->db->join('zimmet_stoklar zs', 'zh.zimmet_stok_no = zs.zimmet_stok_id', 'left');
$this->db->join('zimmet_departmanlar d', 'zh.zimmet_departman_no = d.zimmet_departman_id', 'left');
 
$this->db->order_by('zs.zimmet_stok_adi', 'ASC');



        $viewData["hareketlerdetay"] =  $this->db->get()->result();



        $this->db->select('*');
    $this->db->from('zimmet_departman_kullanici_tanimlari zd');
    $this->db->join('kullanicilar k', 'zd.zimmet_departman_kullanici_tanim_kullanici_no = k.kullanici_id', 'left');
    $this->db->join('zimmet_departmanlar d', 'zd.zimmet_departman_kullanici_tanim_departman_no = d.zimmet_departman_id', 'left');
      

        $viewData["kullanicilar"] =  $this->db->get()->result();




		$viewData["page"] = "zimmet/departman";
		$this->load->view('base_view',$viewData);
	}
public function departmana_stok_tanimla($departman_id)
	{
        $insertData["zimmet_stok_no"] =  $this->input->post("zimmet_stok_no");
        $insertData["zimmet_departman_no"] =  $departman_id;
        $insertData["zimmet_hareket_giris_miktar"] =  $this->input->post("zimmet_hareket_giris_miktar");
        $insertData["zimmet_kullanici_no"] =  0;
        $insertData["zimmet_hareket_cikis_miktar"] =  0;
        $this->db->insert("zimmet_hareketler",$insertData);

        $this->session->set_flashdata('insertedID', $this->input->post("zimmet_stok_no") );
        $this->session->set_flashdata('departmanID', $departman_id );
        $this->session->set_flashdata('count', $this->input->post("zimmet_hareket_giris_miktar") );


        redirect($_SERVER['HTTP_REFERER']);

    }
	 


    public function yeni_stok_ekle()
	{
        $insertData["zimmet_stok_adi"] = $this->input->post("zimmet_stok_adi");

    if ($this->db->insert("zimmet_stoklar", $insertData)) {
        echo "ok";
    } else {
        echo "hata";
    }
    }
}
