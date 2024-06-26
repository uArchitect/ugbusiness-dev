<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musteri extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Musteri_model'); 
        $this->load->model('Merkez_model'); 
        $this->load->model('Sehir_model'); 
        $this->load->model('Ilce_model');         
        $this->load->model('Servis_model'); 
        $this->load->model('Cihaz_model');  
        $this->load->model('Egitim_model'); 
        $this->load->model('Talep_model');    $this->load->model('Talep_yonlendirme_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{ 
        yetki_kontrol("musterileri_goruntule");
      //  $data = $this->Musteri_model->get_all(); 
		//$viewData["musteriler"] = $data;
		$viewData["page"] = "musteri/list";
		$this->load->view('base_view',$viewData);
	}

	public function indextest()
	{ 
        yetki_kontrol("musterileri_goruntule");
        $data = $this->Musteri_model->get_all(); 
		$viewData["musteriler"] = $data;
		$viewData["page"] = "musteri/list3";
		$this->load->view('base_view',$viewData);
	}
	public function add($talep_id = 0,$eski_kayit = 0,$servis_kayit = 0)
	{   
        yetki_kontrol("musteri_ekle");
		$viewData["page"] = "musteri/form";

        $ulke_data = $this->Sehir_model->get_all_ulkeler();    
		$viewData["ulkeler"] = $ulke_data;


        $il_data = $this->Sehir_model->get_all();    
		$viewData["sehirler"] = $il_data;

        $ilce_data = $this->Ilce_model->get_all();    
		$viewData["ilceler"] = $ilce_data;
        if($talep_id != 0){

            $talep_data = $this->Talep_model->get_by_id($talep_id);    
            $viewData["talep"] = $talep_data;
        }

        if($eski_kayit != 0){
        
          $eski_data = $this->db->get_where("t_cihaz",["Logicalref"=>$eski_kayit])->result();  
          $viewData["eski_data"] = $eski_data;
      }


        if($servis_kayit != 0){
        
          $viewData["servis_kayit"] = 1;
      }else{
        $viewData["servis_kayit"] = 0;
      }


		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("musteri_duzenle");
		$check_id = $this->Musteri_model->get_by_id($id); 
        if($check_id){  
            $viewData['musteri'] = $check_id[0];
			$viewData["page"] = "musteri/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('musteri'));
        }
 
	}

    public function profile($id = '')
	{  
        yetki_kontrol("musteri_duzenle");
		$check_id = $this->Musteri_model->get_by_id($id); 
        if($check_id){  
            $viewData['musteri'] = $check_id[0];
          
            $merkezler = $this->Merkez_model->get_all(["merkez_yetkili_id"=>$id]);    
            $viewData["merkezler"] = $merkezler;
            $viewData["urunler"] = $this->Cihaz_model->get_all(["merkez_yetkili_id"=>$id]); 
            $viewData["egitimler"] = $this->Egitim_model->get_all(["merkez_yetkili_id"=>$id]); 
            $viewData["atis_yuklemeleri"] = $this->Servis_model->get_atis_yuklemeleri(["merkez_yetkili_id"=>$id]); 
            $viewData["servisler"] = $this->Servis_model->get_all(["merkez_yetkili_id"=>$id]);    
           
            $viewData["page"] = "musteri/profil"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('musteri'));
        }
 
	}


    public function delete($id)
	{     
        yetki_kontrol("musteri_sil");
		$this->Musteri_model->delete($id);  
        $viewData["page"] = "musteri/list";
		$this->load->view('base_view',$viewData);
	}

    public function pre_up($str){
        $str = str_replace('i', 'İ', $str);
        $str = str_replace('ı', 'I', $str);
        return $str;
    }

	public function save($id = '',$siparis_olustur = '',$servis_kayit = 0)
	{   

        if($id == "0"){
            $id = '';
        }
        if($siparis_olustur == "0"){
            $siparis_olustur = '';
        }


        if(empty($id)){
            yetki_kontrol("musteri_ekle");
        }else{
            yetki_kontrol("musteri_duzenle");
        }
        $this->form_validation->set_rules('musteri_ad',   'Müşteri Adı',  'required'); 
        $this->form_validation->set_rules('musteri_iletisim_numarasi','Müşteri Soyad','required');
        

        $data['musteri_ad']                 = mb_strtoupper($this->pre_up(escape($this->input->post('musteri_ad'))), 'UTF-8');
        $data['musteri_iletisim_numarasi']  = escape(str_replace(" ","",$this->input->post('musteri_iletisim_numarasi')));
        $data['musteri_sabit_numara']       = escape($this->input->post('musteri_sabit_numara'));
        $data['musteri_email_adresi']       = escape($this->input->post('musteri_email_adresi'));
        $data['musteri_cinsiyet']           = escape($this->input->post('musteri_cinsiyet'));
        $data['yetkili_adi_2']              = escape($this->input->post('yetkili_adi_2'));
        $data['yetkili_iletisim_2']         = escape(str_replace(" ","",$this->input->post('yetkili_iletisim_2')));
       
        
        if($this->input->post('fileNames') != "" || $this->input->post('fileNames') != null){
            $data['musteri_dosya'] = escape($this->input->post('fileNames'));

        }
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Musteri_model->get_by_id($id);
            if($check_id){
                unset($data['id']);

                $query = $this->db->where([
                    "musteri_iletisim_numarasi" => $this->input->post('musteri_iletisim_numarasi'),
                    "musteri_id !=" => $id
                ])->get("musteriler");
    
                if(count($query->result()) > 0){
                    $this->session->set_flashdata('flashDanger', escape($this->input->post('musteri_iletisim_numarasi'))." nolu iletişim bilgisiyle daha önce müşteri kaydı oluşturulmuştur. Tekrar müşteri kaydı oluşturulamaz.");
                    redirect($_SERVER['HTTP_REFERER']);
                }
    
                

                $data['musteri_guncelleme_tarihi'] = date('Y-m-d H:i:s');
                $this->Musteri_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){

            
           
            $query = $this->db->where([
                "musteri_iletisim_numarasi" => $this->input->post('musteri_iletisim_numarasi')
            ])->get("musteriler");

            if(count($query->result()) > 0){
                $this->session->set_flashdata('flashDanger', escape($this->input->post('musteri_iletisim_numarasi'))." nolu iletişim bilgisiyle daha önce müşteri kaydı oluşturulmuştur. Tekrar müşteri kaydı oluşturulamaz.");
                redirect($_SERVER['HTTP_REFERER']);
            }



            $data['musteri_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
           
            $this->Musteri_model->insert($data);
            $insert_musteri_id = $this->db->insert_id();
                            
            $musteridata['musteri_kod']   = "M1".str_pad($insert_musteri_id,5,"0",STR_PAD_LEFT);;
            $this->Musteri_model->update($insert_musteri_id,$musteridata);



            $merkez_data["merkez_yetkili_id"] = $insert_musteri_id;
            $merkez_data["merkez_adi"] = mb_strtoupper($this->pre_up(escape($this->input->post('merkez_adi'))), 'UTF-8');
            $merkez_data["merkez_ulke_id"] = escape($this->input->post('ulke_id'));
            
            $merkez_data["merkez_il_id"] = escape($this->input->post('merkez_il_id'));
            $merkez_data["merkez_ilce_id"] = escape($this->input->post('merkez_ilce_id'));
            $merkez_data["merkez_adresi"] = escape($this->input->post('merkez_adresi'));
            $this->Merkez_model->insert($merkez_data);
            $insert_merkez_id = $this->db->insert_id();
            

            if($servis_kayit == 1){
                redirect(site_url('cihaz/cihaz_tanimlama_view/'.$insert_merkez_id)."?filter=servis");
            }
            

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('musteri/ekle'));
        }
		redirect(site_url('musteri'));
	}







    public function musteriler_ajax() {
        yetki_kontrol("musterileri_goruntule");
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        if(!empty($search)) {
            $this->db->like('musteri_ad', $search); 
        }

        $query = $this->db
                      ->select('musteriler.musteri_id,musteriler.musteri_ad,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi, merkezler.merkez_adi,merkezler.merkez_adi,sehirler.sehir_adi,ilceler.ilce_adi')
                      ->from('musteriler')
                      ->join('(SELECT * FROM merkezler ORDER BY merkez_id DESC) as merkezler', 'merkezler.merkez_yetkili_id = musteri_id', 'left')
                      ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
                      ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
                      ->order_by($order, $dir)
                      ->limit($limit, $start)
                      ->group_by('musteriler.musteri_id')
                      ->get();

        $data = [];
        foreach ($query->result() as $row) {
            $data[] = [
                "<span style='opacity:0.5'>#".$row->musteri_kod."</span>",
                '<a style="color:#004795!important;font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #04274d;"></i> '.$row->musteri_ad.'</a>',
                '<i class="fa fa-building" style="color: orange;"></i> '.$row->merkez_adi,
                '<i class="fa fa-map-marker" style="color: green;"></i> '.$row->ilce_adi."/".$row->sehir_adi,
                '<i class="fa fa-building text-primary"></i> '.formatTelephoneNumber($row->musteri_iletisim_numarasi), 
                '<a style="border-color: #000000;background-color:#fff2ce!important;" href="https://ugbusiness.com.tr/cihaz/cihaz_tanimlama_view/'.$row->musteri_id.'" class="btn btn-xs btn-warning"><i class="fa fa-plus-circle"></i> Cihaz Tanımla</a>
                <a href="https://ugbusiness.com.tr/musteri/duzenle/'.$row->musteri_id.'" class="btn btn-xs btn-dark"><i class="fa fa-pen"></i> Düzenle</a>',
            ];
        }
       
        $totalData = $this->db->count_all('musteriler');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }


}
