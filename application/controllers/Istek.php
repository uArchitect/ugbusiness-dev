<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_model'); 
        $this->load->model('Istek_birim_model'); 
        $this->load->model('Istek_kategori_model'); 
        $this->load->model('Is_tip_model'); 
        $this->load->model('Kullanici_model'); 
        $this->load->model('Istek_durum_model'); 
        $this->load->model('Istek_hareket_model'); 
        $this->load->model('Ayar_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
    public function get_ticket_actions($id)
	{
        $data = $this->Istek_hareket_model->get_all_by_ticket_id($id); 
        echo json_encode($data);
	}
	public function index()
	{  

       
     
        $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        if($check_id[0]->kullanici_id == 1 || $check_id[0]->kullanici_id == 7){
            $data = $this->Istek_model->get_all(); 
        }
        else if($check_id[0]->kullanici_id == 9){
            $data = $this->Istek_model->get_all(["istek_sorumlu_kullanici_id" => $check_id[0]->kullanici_id],["istek_yonetici_id" => $check_id[0]->kullanici_id],["gizli_not !="=>""]); 
     
        }
        else{
            $data = $this->Istek_model->get_all(["istek_sorumlu_kullanici_id" => $check_id[0]->kullanici_id],["istek_yonetici_id" => $check_id[0]->kullanici_id]); 
        }

        if($check_id[0]->kullanici_departman_id == 19){
            redirect(base_url("ugajans"));
                    }
                 

		$viewData["istekler"] = $data;
		$viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);





	}
    public function get_by_categori($category_id)
	{
       // $data = $this->Istek_model->get_all(["istek_birim_no" => $category_id]); 
		//$viewData["istekler"] = $data;
		$viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);
	}
	public function add()
	{   
    
        $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        if($check_id[0]->kullanici_departman_id == 19){
            redirect(base_url("ugajans"));
                    }
                 
        $istek_birimleri = $this->Istek_birim_model->get_all(); 
        $istek_kategorileri = $this->Istek_kategori_model->get_all(); 
        $is_tipleri = $this->Is_tip_model->get_all();
        $durum_data = $this->Istek_durum_model->get_all(); 
        $viewData["istek_durumlari"] = $durum_data;  
        $viewData["istek_birimleri"] = $istek_birimleri; 
        $viewData["istek_kategorileri"] = $istek_kategorileri;
        $viewData["is_tipleri"] = $is_tipleri;
        $viewData["departman_adi"] = $check_id[0]->departman_adi;
        $viewData["email_adresi"] = $check_id[0]->kullanici_email_adresi;
        $viewData["iletisim_numarasi"] = $check_id[0]->kullanici_bireysel_iletisim_no;
        $viewData["dahili_numarasi"] = $check_id[0]->kullanici_dahili_iletisim_no;
       
       
        $kullanici_data =  $this->db->order_by('kullanici_ad_soyad', 'ASC')->where("kullanici_departman_id !=",19)->where(["rehberde_goster"=>1])->or_where(["kullanici_id"=>7])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar")->result();


        $viewData["kullanicilar"] = $kullanici_data;



		$viewData["page"] = "istek/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
         

        $checkus_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
      

		$check_id = $this->Istek_model->get_all(["istek_id"=>$id]); 

          
        if($check_id[0]->istek_yonetici_id != aktif_kullanici()->kullanici_id){
            if($check_id[0]->istek_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
                $this->session->set_flashdata('flashDanger', "Bu talebi düzenleme yetkiniz bulunmamaktadır.");
                redirect(site_url('istek'));
            }
        }

        if($check_id){  
           
                   
            $istek_birimleri = $this->Istek_birim_model->get_all(); 
            $istek_kategorileri = $this->Istek_kategori_model->get_all(); 
            $is_tipleri = $this->Is_tip_model->get_all(); 
            $kullanici_data = $this->Kullanici_model->get_all();  
            $durum_data = $this->Istek_durum_model->get_all(); 
            $viewData["istek_durumlari"] = $durum_data;  
            $viewData["kullanicilar"] = $kullanici_data;
            $viewData["istek_birimleri"] = $istek_birimleri; 
            $viewData["istek_kategorileri"] = $istek_kategorileri;
            $viewData["is_tipleri"] = $is_tipleri;
            $viewData["departman_adi"] = $check_id[0]->departman_adi;
            $viewData["email_adresi"] = $checkus_id[0]->kullanici_email_adresi;
            $viewData["iletisim_numarasi"] = $checkus_id[0]->kullanici_bireysel_iletisim_no;
            $viewData["dahili_numarasi"] = $checkus_id[0]->kullanici_dahili_iletisim_no;
            $viewData['istek'] = $check_id[0];

                


			$viewData["page"] = "istek/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('istek'));
        }
 
	}


    public function report($id){
        yetki_kontrol("istek_rapor_goruntule");
        $check_id = $this->Istek_model->get_by_id($id);
        $viewData["istek"] =$check_id[0]; 

        $data = $this->Istek_hareket_model->get_all_by_ticket_id($id); 
        $viewData["istek_hareketleri"] =$data; 

        $yonetici = $this->Kullanici_model->get_by_id($check_id[0]->istek_yonetici_id); 
        $viewData["yonetici"] =$yonetici; 


        $viewData["page"] = "istek/report"; 
        $this->load->view('base_view',$viewData); 
    }
    public function delete($id)
	{     
        $check_id = $this->Istek_model->get_by_id($id); 
        if($check_id[0]->istek_durum_no != 2){
            $this->session->set_flashdata('flashDanger', "Sadece beklemede olan kayıtları silebilirsiniz.");
            redirect(site_url('istek')); 
        }
           if($check_id[0]->istek_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
                $this->session->set_flashdata('flashDanger', "Bu talebi silme yetkiniz bulunmamaktadır.");
                redirect(site_url('istek'));
            }
        


		$this->Istek_model->delete($id);  
        $viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);
	}

    public function update_success_ticket($id){  
        yetki_kontrol("istek_onayla");

        $data['istek_durum_no'] = 2;
        $data['istek_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Istek_model->update($id,$data);  

        $istek_kayit = $this->Istek_model->get_by_id($id); 

        sendSMS($istek_kayit[0]);

        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek durumu [Onaylandı] olarak değiştirildi.";
        $this->Istek_hareket_model->insert($action_data);
    }
    public function update_danger_ticket($id){
    
        yetki_kontrol("istek_reddet");

        $data['istek_durum_no'] = 5;
        $data['istek_red_tarihi'] = date('Y-m-d H:i:s');
        $this->Istek_model->update($id,$data);

        $istek_kayit = $this->Istek_model->get_by_id($id); 

        sendSMS($istek_kayit[0]);

        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek durumu [Reddedildi] olarak değiştirildi.";
        $this->Istek_hareket_model->insert($action_data);
    }

    public function update_start_ticket($id){  
   
        yetki_kontrol("istek_isleme_al");
        $data['istek_durum_no'] = 3;
        $data['istek_isleme_alinma_tarihi'] = date('Y-m-d H:i:s');
        $this->Istek_model->update($id,$data);

        
        $istek_kayit = $this->Istek_model->get_by_id($id); 

        sendSMS($istek_kayit[0]);

        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek durumu [İşleme Alındı] olarak değiştirildi.";
        $this->Istek_hareket_model->insert($action_data);
    }

	public function save($id = '')
	{   

         
        if(empty($id)){
           


            
$klist = json_decode(json_encode($this->input->post('istek_yonetici_id')));
foreach ($klist as $gonderilenkullanici) {
    

$this->form_validation->set_rules('istek_adi',  'Istek Adı',  'required'); 

$data['istek_kategori_no']  = escape($this->input->post('istek_kategori_no'));
$data['is_tip_no']  = escape($this->input->post('is_tip_no'));
$data['istek_guncelleme_tarihi'] = date('Y-m-d H:i:s');
$data['istek_oncelik'] = escape($this->input->post('istek_oncelik'));
$data['istek_birim_no'] = escape($this->input->post('istek_birim_no'));
$data['istek_yonetici_id'] = $gonderilenkullanici;

    $data['istek_durum_no'] = escape($this->input->post('istek_durum_no'));


$data['istek_notu'] = escape($this->input->post('istek_notu'));

if ($this->form_validation->run() != FALSE && !empty($id)) {
    $check_id = $this->Istek_model->get_by_id($id);
    if($check_id){
        
        $this->Istek_model->update($id,$data);
        
        $istek_kayit = $this->Istek_model->get_by_id($id);
        sendSMS($istek_kayit[0]);
                    
        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek kayıt bilgileri düzenlendi.";
        $this->Istek_hareket_model->insert($action_data);



    }
}elseif($this->form_validation->run() != FALSE && empty($id)){
    if($this->input->post("gonderen_sorumlu") == 7 || $this->input->post("gonderen_sorumlu") == 9 ){
        if($this->session->userdata('aktif_kullanici_id') == 9){
            $data['istek_sorumlu_kullanici_id']  = escape($this->input->post("gonderen_sorumlu"));
            if($this->input->post("gonderen_sorumlu") == 7){
                $data['istek_adi']  = str_replace("İbrahim Bircan","Uğur Ölmez",escape($this->input->post('istek_adi')));
                $data['gizli_not']  = "İbrahim Bircan tarafından Uğur ÖLMEZ adıyla gönderilmiştir.";


            }else{
                $data['istek_adi']  = escape($this->input->post('istek_adi'));

            }
        }else{
            $data['istek_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
            $data['istek_adi']  = escape($this->input->post('istek_adi'));

        }
       
    }else{
        $data['istek_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
        $data['istek_adi']  = escape($this->input->post('istek_adi'));

    }
   $data['istek_aciklama']  =      str_replace(["\r\n", "\r", "\n"], ' ', $this->input->post('istek_aciklama'));

   $this->Istek_model->insert($data);
   $inserted_id = $this->db->insert_id();
   $stok_kodu = "D".date("dmY").$inserted_id;
   $this->Istek_model->update($inserted_id,["istek_kodu" => $stok_kodu]);

    $kullanici =  $this->Kullanici_model->get_by_id($gonderilenkullanici); 
    
    if($this->session->userdata('aktif_kullanici_id') == 9){
        sendSmsData($this->Kullanici_model->get_all(["kullanici_id"=>$gonderilenkullanici])[0]->kullanici_bireysel_iletisim_no, $this->Kullanici_model->get_all(["kullanici_id"=>$this->input->post('gonderen_sorumlu')])[0]->kullanici_ad_soyad." tarafından ".date("d.m.Y H:i")." tarihinde yeni istek bildirimi oluşturulmuştur.");


    }else{
        sendSmsData($this->Kullanici_model->get_all(["kullanici_id"=>$gonderilenkullanici])[0]->kullanici_bireysel_iletisim_no, aktif_kullanici()->kullanici_ad_soyad." tarafından ".date("d.m.Y H:i")." tarihinde yeni istek bildirimi oluşturulmuştur.");

    }
   

    $istek_kayit = $this->Istek_model->get_by_id($inserted_id);

    $action_data['istek_no'] = $inserted_id;
    $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
    $action_data['istek_hareket_detay'] = "İstek bildirimi oluşturuldu.";
    $this->Istek_hareket_model->insert($action_data);

    $action_data['istek_no'] = $inserted_id;
    $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
    $action_data['istek_hareket_detay'] = "İstek onay için <b>".$kullanici[0]->kullanici_ad_soyad." / ".$kullanici[0]->departman_adi."</b> kullanıcısına yönlendirildi.";
    $this->Istek_hareket_model->insert($action_data);

}else{
    $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
    redirect(site_url('istek/ekle'));
}

# code...
}





        }else{
          
         
$this->form_validation->set_rules('istek_adi',  'Istek Adı',  'required'); 

 

    $data['istek_durum_no'] = escape($this->input->post('istek_durum_no'));


$data['istek_notu'] = escape($this->input->post('istek_notu'));

if ($this->form_validation->run() != FALSE && !empty($id)) {
    $check_id = $this->Istek_model->get_by_id($id);
    if($check_id){
        
        $this->Istek_model->update($id,$data);
        
        $istek_kayit = $this->Istek_model->get_by_id($id);
        sendSMS($istek_kayit[0]);
                   
        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek kayıt bilgileri düzenlendi.";
        $this->Istek_hareket_model->insert($action_data);
    }
}
 
     }
        
		redirect(site_url('istek'));
	}
}
