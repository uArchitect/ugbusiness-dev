<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Dokuman_model'); 
        $this->load->model('Dokuman_kategori_model'); 
        $this->load->model('Dokuman_revizyon_model');
        $this->load->model('Dokuman_inceleme_model');
        $this->load->model('Dokuman_goruntuleme_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
    function dragDropUpload(){ 
        header('Content-Type: application/json');
        
        if(!empty($_FILES)){ 
            $uploadPath = 'uploads/'; 
            $config['upload_path'] = $uploadPath; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx'; 
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = false;
             
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
             
            if($this->upload->do_upload('file')){ 
                $fileData = $this->upload->data(); 
                $uploadData['file_name'] = $fileData['file_name']; 
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s"); 
                
                // JSON response döndür
                echo json_encode([
                    'status' => 'success',
                    'file_name' => $fileData['file_name'],
                    'message' => 'Dosya başarıyla yüklendi'
                ]);
                return;
            } else {
                // Hata durumu
                $error = $this->upload->display_errors('', '');
                echo json_encode([
                    'status' => 'error',
                    'message' => $error ? $error : 'Dosya yüklenirken bir hata oluştu'
                ]);
                return;
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Dosya bulunamadı'
            ]);
            return;
        }
    } 
    
	public function index($kategori = 0)
	{
        yetki_kontrol("dokuman_goruntule");
        if($kategori != 0){
            $data = $this->Dokuman_model->get_all(["dokuman_kategori_no"=>$kategori]); 
        }else{
            $data = $this->Dokuman_model->get_all(); 
        }
        $data_kategori                = $this->Dokuman_kategori_model->get_by_id($kategori); 
		$viewData["dokumanlar"]       = $data;
        $viewData["dokuman_kategori"] = $data_kategori[0] ?? null;
		$viewData["page"]             = "dokuman/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("dokuman_ekle");
        $dokuman_kategorileri             = $this->Dokuman_kategori_model->get_all(); 
		$viewData["dokuman_kategorileri"] = $dokuman_kategorileri;
        $data                             = $this->Dokuman_model->get_all(); 
        $viewData["dokumanlar"]           = $data;
		$viewData["page"]                 = "dokuman/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("dokuman_duzenle");
		$check_id = $this->Dokuman_model->get_by_id($id); 
        if($check_id){  
            $dokuman_kategorileri = $this->Dokuman_kategori_model->get_all(); 
		    $viewData["dokuman_kategorileri"] = $dokuman_kategorileri;
            $data = $this->Dokuman_revizyon_model->get_all(["revizyon_dokuman_no"=>$id]); 
            $viewData["revizyonlar"] = $data;
            $inceleme_data = $this->Dokuman_inceleme_model->get_all(["inceleme_dokuman_no"=>$id]); 
            $viewData["incelemeler"] = $inceleme_data;
            $viewData['dokuman'] = $check_id[0];
			$viewData["page"] = "dokuman/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('dokuman'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("dokuman_sil");
		$this->Dokuman_model->delete($id);  
        $viewData["page"] = "dokuman/list";
		$this->load->view('base_view',$viewData);
	}


    public function revizyon_goruntule($document_id)
	{   
        $this->db->select("*")->where(["revizyon_dokuman_no"=>$document_id]);
        $this->db->from("dokuman_revizyonlari");
        $this->db->limit(1);
        $this->db->order_by('revizyon_id',"DESC");
        $query = $this->db->get();
        $result = $query->result();  

        $data["dokuman_no"]  = $document_id;
        $data["revizyon_no"] = $result[0]->revizyon_id;
        $data["kullanici_no"] = escape($this->session->userdata('aktif_kullanici_id'));
        $this->Dokuman_goruntuleme_model->insert($data);

        redirect(base_url("uploads/").$result[0]->revizyon_dosya_adi);
        
    }
    public function inceleme_ekle($id = '')
	{   
        yetki_kontrol("gozden_gecirme_ekle");
        $data['inceleme_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
        $data['inceleme_dokuman_no']            = escape($id);
        $this->Dokuman_inceleme_model->insert($data);
		redirect(site_url('dokuman/duzenle/').$id);
	}

    public function revizyon_ekle($id = '')
	{  
        yetki_kontrol("dokuman_revizyon_ekle");
        $this->form_validation->set_rules('dokuman_adi',  'Dokuman Adı',  'required'); 
        
        $data['revizyon_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
        $data['revizyon_dokuman_no']  = $id;
        $data['revizyon_kodu']        = escape($this->input->post('revizyon_kodu'));
        $data['revizyon_aciklama']    = escape($this->input->post('revizyon_aciklama'));
        $data['revizyon_dosya_adi']   = escape($this->input->post('revizyonFileNames'));
      
        $this->Dokuman_revizyon_model->insert($data);
        
		redirect(site_url('dokuman/duzenle/').$id);
	}

	public function save($id = '')
	{  
        if(empty($id)){
            yetki_kontrol("dokuman_ekle");
        }else{
            yetki_kontrol("dokuman_duzenle");
        }

        $this->form_validation->set_rules('dokuman_adi',  'Dokuman Adı',  'required'); 
        
        $data['dokuman_adi']                = escape($this->input->post('dokuman_adi'));
        $data['dokuman_aciklama']           = escape($this->input->post('dokuman_aciklama'));
        $data['dokuman_guncelleme_tarihi']  = date('Y-m-d H:i:s');
        $data['dokuman_belge_no']           = escape($this->input->post('dokuman_belge_no'));
        $data['dokuman_kategori_no']        = escape($this->input->post('dokuman_kategori_no'));
        $data['dokuman_yururluk_tarihi']    = escape($this->input->post('dokuman_yururluk_tarihi'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Dokuman_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Dokuman_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){

            $data['dokuman_sorumlu_kullanici_id'] = escape($this->session->userdata('aktif_kullanici_id'));
            $this->Dokuman_model->insert($data);
            $datarev['revizyon_sorumlu_kullanici_id'] = escape($this->session->userdata('aktif_kullanici_id'));
            $datarev['revizyon_dokuman_no']  = $this->db->insert_id();
            $datarev['revizyon_kodu']  = escape("ANA BELGE");
            $datarev['revizyon_aciklama']  = escape("Otomatik revizyon kaydı oluşturulmuştur.");
             if($this->input->post('fileNames')!= null){
                $datarev['revizyon_dosya_adi'] = escape($this->input->post('fileNames'));
            }
            $this->Dokuman_revizyon_model->insert($datarev);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect($_SERVER['HTTP_REFERER']);
	}
}
