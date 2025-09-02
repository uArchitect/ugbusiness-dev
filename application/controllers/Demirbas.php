<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Demirbas_model'); 
        $this->load->model('Demirbas_kategori_model'); 
        $this->load->model('Demirbas_birim_model'); 
        $this->load->model('Kullanici_model');
        $this->load->model('Demirbas_islem_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($birim = 0)
    { 
            
        yetki_kontrol("demirbas_goruntule");
 
            if($birim != 0){
                 $data = $this->Demirbas_model->get_all(["demirbas_birim_no"=>$birim]); 
                 $viewData["kategori_kontrol"] = true;
            }else{
                $data = $this->Demirbas_model->get_all(); 
            }

            $viewData["envanterler"] = $this->db->order_by('demirbas_id', 'ASC')
        
                    ->join('kullanicilar', 'kullanicilar.kullanici_id = demirbas_kullanici_id')
                    ->join('demirbas_kategorileri', 'demirbas_kategorileri.demirbas_kategori_id = kategori_id')
                    ->get("demirbaslar")->result();
           

            $this->db->distinct();
$query = $this->db->select('kullanicilar.kullanici_id, kullanicilar.kullanici_ad_soyad')
      ->order_by('kullanici_ad_soyad', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = demirbas_kullanici_id')
      ->join('demirbas_kategorileri', 'demirbas_kategorileri.demirbas_kategori_id = kategori_id')
      ->get("demirbaslar");

		$viewData["demirbaslar"] = $query->result();
		$viewData["page"] = "demirbas/list";
		$this->load->view('base_view',$viewData);
	}

    public function add($kategori = 0)
	{   
        yetki_kontrol("demirbas_ekle");
        $viewData["demirbas_secilen_kategori"] = $kategori;
        
        $data = $this->Demirbas_kategori_model->get_all(); 
		$viewData["demirbas_kategorileri"] = $data;
        
        $kullanici_data = $this->Kullanici_model->get_all();    
        $viewData["kullanicilar"] = $kullanici_data;

		$viewData["page"] = "demirbas/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("demirbas_duzenle");
		$check_id = $this->Demirbas_model->get_by_id($id); 
        if($check_id){  
            $demirbas_birimleri_data = $this->Demirbas_birim_model->get_all(); 
            $viewData["demirbas_birimleri"] = $demirbas_birimleri_data;

            $data = $this->Demirbas_kategori_model->get_all(); 
		    $viewData["demirbas_kategorileri"] = $data;
            
            $kullanici_data = $this->Kullanici_model->get_all();    
            $viewData["kullanicilar"] = $kullanici_data;

            $viewData["demirbas_secilen_kategori"] = $check_id[0]->kategori_id;
        
            $islem_data = $this->Demirbas_islem_model->get_all(["islem_demirbas_no"=>$id]);    
            $viewData["demirbas_islemleri"] = $islem_data;

            $viewData['demirbas'] = $check_id[0];
			$viewData["page"] = "demirbas/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('demirbas'));
        }
 
	}

    public function delete($id)
	{    
        yetki_kontrol("demirbas_sil"); 
		$this->Demirbas_model->delete($id);  
        $viewData["page"] = "demirbas/list";
		$this->load->view('base_view',$viewData);
	}

    public function delete_action($demirbas_id,$id)
	{   
        yetki_kontrol("demirbas_islem_sil"); 
		$this->Demirbas_islem_model->delete($id);  
        redirect(base_url("demirbas/duzenle/$demirbas_id"));
	}


    public function save_action($id = '')
	{   
        
        yetki_kontrol("demirbas_islem_kayit_ekle");
       

        $data['islem_sorumlu_kullanici_id'] = escape($this->session->userdata('aktif_kullanici_id'));
        $data['islem_aciklama']             = escape($this->input->post('islem_aciklama'));
        $data['islem_demirbas_no']          = $id;
        $this->Demirbas_islem_model->insert($data);
		redirect(site_url('demirbas/duzenle/').$id);
	}


public function kategori_duzenle($id,$new_kategori_id)
	{  
$this->db->where("demirbas_id",$id)->update("demirbaslar",["kategori_id"=>$new_kategori_id]);
redirect(base_url("demirbas/duzenle/$id"));
    }
	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("demirbas_ekle");
        }else{
            yetki_kontrol("demirbas_duzenle");
        }
  
        
        $data['kategori_id']                    = escape($this->input->post('kategori_id'));
        $data['demirbas_kullanici_id']          = escape($this->input->post('demirbas_kullanici_id'));
        $data['demirbas_aciklama']              = escape($this->input->post('demirbas_aciklama'));

        if($this->input->post('kategori_id') == 1){

            $data['demirbas_marka']                 = escape($this->input->post('demirbas_marka'));
            $data['demirbas_pin_kodu']          = escape($this->input->post('demirbas_pin_kodu'));
            $data['demirbas_puk_kodu']          = escape($this->input->post('demirbas_puk_kodu'));
            $data['demirbas_garanti_bitis_tarihi']     = date('Y-m-d',strtotime($this->input->post('demirbas_garanti_bitis_tarihi')));
            $data['demirbas_icloud_adres']                 = escape($this->input->post('demirbas_icloud_adres'));
            $data['demirbas_telefon_numarasi']                   = escape($this->input->post('demirbas_telefon_numarasi'));
            $data['demirbas_icloud_sifre']                 = escape($this->input->post('demirbas_icloud_sifre'));
        }


         if($this->input->post('kategori_id') == 1){

            $data['demirbas_marka']                 = escape($this->input->post('demirbas_marka'));
            }


        if($this->input->post('kategori_id') == 2){
            $data['demirbas_marka']                 = escape($this->input->post('demirbas_marka'));
        $data['demirbas_tablet_sifresi']                 = escape($this->input->post('demirbas_tablet_sifresi'));
        $data['demirbas_garanti_bitis_tarihi']     = date('Y-m-d',strtotime($this->input->post('demirbas_garanti_bitis_tarihi')));
        }

        if($this->input->post('kategori_id') == 3){
            $data['demirbas_multinet_kart_no']                 = escape($this->input->post('demirbas_multinet_kart_no'));
            $data['demirbas_multinet_bakiye']                 = escape($this->input->post('demirbas_multinet_bakiye'));
  $data['demirbas_multinet_cvv']                 = escape($this->input->post('demirbas_multinet_cvv'));

            $data['demirbas_multinet_kart_gecerlilik_tarihi']     = date('Y-m-d',strtotime($this->input->post('demirbas_multinet_kart_gecerlilik_tarihi')));
        }

        if($this->input->post('kategori_id') == 4){
            $data['demirbas_marka']                 = escape($this->input->post('demirbas_marka'));
           
              $data['demirbas_garanti_bitis_tarihi']     = date('Y-m-d',strtotime($this->input->post('demirbas_garanti_bitis_tarihi')));
        }



 
         
        
        if (!empty($id)) {
            $check_id = $this->Demirbas_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                
                $this->Demirbas_model->update($id,$data);
            }
        }elseif(empty($id)){
            
            $this->Demirbas_model->insert($data);
            $inserted_id = $this->db->insert_id();
      
 
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('demirbas/ekle/'.$data['kategori_id']));
        }
		redirect(site_url('demirbas'));
	}
}
