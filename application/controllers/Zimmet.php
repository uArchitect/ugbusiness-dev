<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zimmet extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	
    public function dagitim($departman_id,$hareketid=0)
	{ 
        
      
        
        $data = $this->db->get("zimmet_stoklar")->result();
		$viewData["stoklar"] = $data;
if($hareketid != 0){
    $viewData["secilen_hareket"] = $this->db->where("zimmet_hareket_id",$hareketid)->get("zimmet_hareketler")->result()[0];
}


        $this->db->select('
    zs.*,
    zh.*,
    d.* ,k.kullanici_ad_soyad,k.kullanici_id
');
$this->db->from('zimmet_hareketler zh');
$this->db->join('zimmet_stoklar zs', 'zh.zimmet_stok_no = zs.zimmet_stok_id', 'left');
$this->db->join('zimmet_departmanlar d', 'zh.zimmet_departman_no = d.zimmet_departman_id', 'left');
$this->db->join('kullanicilar k', 'zh.zimmet_kullanici_no = k.kullanici_id', 'left');
 
$this->db->order_by('zs.zimmet_stok_adi', 'ASC');



        $viewData["kullanicihareketlerdetay"] =  $this->db->get()->result();



        $this->db->select('*');
    $this->db->from('zimmet_departman_kullanici_tanimlari zd');
    $this->db->join('kullanicilar k', 'zd.zimmet_departman_kullanici_tanim_kullanici_no = k.kullanici_id', 'left');
    $this->db->order_by('k.kullanici_ad_soyad', 'ASC');


        $viewData["kullanicilar"] =  $this->db->get()->result();

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

	$viewData["secilen_departman"] = $departman_id;
		$viewData["page"] = "zimmet/dagitim";
		$this->load->view('base_view',$viewData);

    }
    
     public function uretimbolumyonetimi()
	{ 


        
  $viewData["listkullanicilar"] = $this->db->where("kullanici_aktif",1)->order_by("kullanici_ad_soyad","asc")->get("kullanicilar")->result();
        $viewData["bolumler"] = $this->db->get("zimmet_alt_bolumler")->result();
		$viewData["page"] = "zimmet/zimmet_uretim_bolum_yonetim";
		$this->load->view('base_view',$viewData);
    }
    public function uretimdagitim($departman_id,$hareketid=0)
	{ 
        
      
        
        $data = $this->db->get("zimmet_stoklar")->result();
		$viewData["stoklar"] = $data;
if($hareketid != 0){
    $viewData["secilen_hareket"] = $this->db->where("zimmet_hareket_id",$hareketid)->get("zimmet_hareketler")->result()[0];
}


        $this->db->select('
    zs.*,
    zh.*,
    d.* ,k.zimmet_alt_bolum_adi
');
$this->db->from('zimmet_hareketler zh');
$this->db->join('zimmet_stoklar zs', 'zh.zimmet_stok_no = zs.zimmet_stok_id', 'left');
$this->db->join('zimmet_departmanlar d', 'zh.zimmet_departman_no = d.zimmet_departman_id', 'left');
$this->db->join('zimmet_alt_bolumler k', 'zh.zimmet_hareket_alt_bolum_no = k.zimmet_alt_bolum_id ', 'left');
 
$this->db->order_by('zs.zimmet_stok_adi', 'ASC');



        $viewData["kullanicihareketlerdetay"] =  $this->db->get()->result();



        $this->db->select('*');
    $this->db->from('zimmet_alt_bolumler'); 


        $viewData["kullanicilar"] =  $this->db->get()->result();

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

	$viewData["secilen_departman"] = $departman_id;
		$viewData["page"] = "zimmet/uretimdagitim";
		$this->load->view('base_view',$viewData);

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
	 

 
    public function update_zimmet_stok_adi() {
        
        $id = $this->input->post('id');
        $new_name = $this->input->post('new_name');
        
         
        $result = $this->db->where("zimmet_stok_id",$id)->update("zimmet_stoklar", ["zimmet_stok_adi"=>$new_name]);
        
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => true]);
        }
    }


    public function kullaniciya_stok_tanim_guncelle($departman_id,$hareket_id)
	{






        

        $this->db->where("zimmet_departman_no", $departman_id);
        $this->db->where("zimmet_stok_no", $this->input->post("zimmet_stok_no"));
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
        $controlstok = $this->db->get()->result()[0];
        if($this->input->post("temp_miktar") < $this->input->post("zimmet_hareket_giris_miktar")){
            if( $controlstok->kalan <  ($this->input->post("zimmet_hareket_giris_miktar")-$this->input->post("temp_miktar"))){
                $this->session->set_flashdata('flashDanger', "Kullanıcıya tanımlamak istediğiniz stok miktarı, güncel stok miktarından fazla. Tanımlama işlemi başarısız." );
        
                redirect($_SERVER['HTTP_REFERER']);
            }
        
        }
   





        $updateData["zimmet_stok_no"] =  $this->input->post("zimmet_stok_no");
        $updateData["zimmet_departman_no"] =  $departman_id;
        $updateData["zimmet_hareket_giris_miktar"] =  0;
        $updateData["zimmet_kullanici_no"] =  $this->input->post("zimmet_kullanici_no");
        $updateData["zimmet_hareket_cikis_miktar"] =  $this->input->post("zimmet_hareket_giris_miktar");
        $this->db->where("zimmet_hareket_id",$hareket_id)->update("zimmet_hareketler",$updateData);

        

        redirect(base_url("zimmet/dagitim/$departman_id"));

    }



public function bolume_stok_tanim_guncelle($departman_id,$hareket_id)
	{






        

        $this->db->where("zimmet_departman_no", $departman_id);
        $this->db->where("zimmet_stok_no", $this->input->post("zimmet_stok_no"));
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
        $controlstok = $this->db->get()->result()[0];
        if($this->input->post("temp_miktar") < $this->input->post("zimmet_hareket_giris_miktar")){
            if( $controlstok->kalan <  ($this->input->post("zimmet_hareket_giris_miktar")-$this->input->post("temp_miktar"))){
                $this->session->set_flashdata('flashDanger', "Tanımlamak istediğiniz stok miktarı, güncel stok miktarından fazla. Tanımlama işlemi başarısız." );
        
                redirect($_SERVER['HTTP_REFERER']);
            }
        
        }
   





        $updateData["zimmet_stok_no"] =  $this->input->post("zimmet_stok_no");
        $updateData["zimmet_departman_no"] =  $departman_id;
        $updateData["zimmet_hareket_giris_miktar"] =  0;
        $updateData["zimmet_kullanici_no"] =  0;
                $updateData["zimmet_hareket_alt_bolum_no"] =  $this->input->post("zimmet_kullanici_no");
        $updateData["zimmet_hareket_cikis_miktar"] =  $this->input->post("zimmet_hareket_giris_miktar");
        $this->db->where("zimmet_hareket_id",$hareket_id)->update("zimmet_hareketler",$updateData);

        

        redirect(base_url("zimmet/uretimdagitim/$departman_id"));

    }


public function bolum_kullanici_tanimla($bolum_id)
	{
         $k_id =$this->input->post("kullanici_no");
         $controlkullanici = $this->db->where("zimmet_alt_bolum_no",$bolum_id)->where("zimmet_alt_bolum_kullanici_no",$k_id)->get("zimmet_alt_bolum_kullanici_tanimlari")->result()[0];

               if(count($controlkullanici) > 0){
                $this->session->set_flashdata('flashDanger', "Tanımlamak istediğiniz kullanıcı, bu bölüme daha önce kaydedilmiştir. Tanımlama işlemi başarısız." );
               }else{
                 $insertData["zimmet_alt_bolum_kullanici_no"] = $k_id;
                 $insertData["zimmet_alt_bolum_no"] = $bolum_id; 
                 $this->db->insert("zimmet_hareketler",$insertData);
                 $this->session->set_flashdata('flashSuccess', "Kullanıcı Bölüm Ataması Başarıyla Gerçekleştirilmiştir." );
               }
              
                redirect($_SERVER['HTTP_REFERER']);

    }


    public function toplu_stok_kaydet($departman_id)
	{

        $miktarlar =$this->input->post("miktar");
        $stoklar =$this->input->post("name");
        $id =$this->input->post("id");
         $kid =$this->input->post("zimmet_kullanici_no");
        for ($i=0; $i < count($miktarlar); $i++) { 
           
            if($miktarlar[$i] != "" && $miktarlar[$i] != 0){
                $insertData["zimmet_stok_no"] =  $id[$i];
                $insertData["zimmet_departman_no"] =  $departman_id;
                $insertData["zimmet_hareket_giris_miktar"] =  0;
                $insertData["zimmet_kullanici_no"] =   $kid;
                $insertData["zimmet_hareket_cikis_miktar"] = $miktarlar[$i];
                $this->db->insert("zimmet_hareketler",$insertData);
            }
         
   
        }
  

        redirect($_SERVER['HTTP_REFERER']);

    }




    
 public function toplu_stok_kaydet_uretim($departman_id)
	{

        $miktarlar =$this->input->post("miktar");
        $stoklar =$this->input->post("name");
        $id =$this->input->post("id");
         $kid =$this->input->post("zimmet_kullanici_no");
        for ($i=0; $i < count($miktarlar); $i++) { 
           
            if($miktarlar[$i] != "" && $miktarlar[$i] != 0){
                $insertData["zimmet_stok_no"] =  $id[$i];
                $insertData["zimmet_departman_no"] =  $departman_id;
                $insertData["zimmet_hareket_giris_miktar"] =  0;
                $insertData["zimmet_kullanici_no"] =   0;
                $insertData["zimmet_hareket_alt_bolum_no"] =   $kid;
                $insertData["zimmet_hareket_cikis_miktar"] = $miktarlar[$i];
                $this->db->insert("zimmet_hareketler",$insertData);
            }
         
   
        }
  

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
