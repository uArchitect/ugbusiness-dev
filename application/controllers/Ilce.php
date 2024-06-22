<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ilce extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ilce_model'); 
        $this->load->model('Sehir_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }

	public function add()
	{  
        yetki_kontrol("il_ilce_kayit_ekle");
        $data_sehir = $this->Sehir_model->get_all();  
		$viewData["sehirler"] = $data_sehir;

		$viewData["page"] = "ilce/form";
        
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("il_ilce_kayit_duzenle");
		$check_id = $this->Ilce_model->get_by_id($id); 
        if($check_id){  
            $data_sehir = $this->Sehir_model->get_all();  
		    $viewData["sehirler"] = $data_sehir;
            $viewData['ilce'] = $check_id[0];
			$viewData["page"] = "ilce/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('sehir'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("il_ilce_kayit_sil");
		$this->Ilce_model->delete($id);  
        $viewData["page"] = "ilce/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("il_ilce_kayit_ekle");
        }else{
            yetki_kontrol("il_ilce_kayit_duzenle");
        }

        $this->form_validation->set_rules('ilce_adi',  'İlçe Adı',  'required'); 
         
        $data['ilce_adi']  = escape($this->input->post('ilce_adi'));  

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Ilce_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Ilce_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->Ilce_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('ilce/ekle'));
        }
		redirect(site_url('sehir'));
	}





    public function get_ilceler($il_id)
    {
         
        if (empty($il_id) )
        {
            $data = array('status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı..!');
        }
        else
        {
            $ilceler = $this->db->get_where('ilceler', array('sehir_id' => $il_id));
            if ( $ilceler->num_rows() > 0 )
            {
                $ilceList = array();
                foreach ($ilceler->result() as $item) {
                    $ilceList[] = array('id' => $item->ilce_id, 'ilce' => $item->ilce_adi);
                }
                $data = array('status' => 'ok', 'message' => '', 'data' => $ilceList);
            }
            else
            {
                $data = array('status' => 'error', 'message' => 'İlçe Bulunamadı..!');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }

}
