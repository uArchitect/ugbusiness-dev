<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urun extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Urun_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("Urun_goruntule");
        $data = $this->Urun_model->get_all(); 
		$viewData["urunlar"] = $data;
		$viewData["page"] = "urun/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("Urun_ekle");
		$viewData["page"] = "urun/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("Urun_duzenle");
		$check_id = $this->Urun_model->get_by_id($id); 
        if($check_id){  


            $fiyatlar = [];
            for ($p = 90000; $p <= 230000; $p+=20000) {
                
                for($v = 20; $v >= 1; $v--){
                    if($v%2 == 1 && $v != 1) continue;
                    
                    $senet_result = (($check_id[0]->urun_satis_fiyati-$p)*(($check_id[0]->urun_vade_farki/12)*$v)+($check_id[0]->urun_satis_fiyati-$p)) ;


                $urun = new stdClass();
                $urun->pesinat_fiyati = $p;
                $urun->vade = $v;
                $urun->senet = $senet_result;
                $urun->aylik_taksit_tutar = $senet_result / $v;
                $urun->toplam_dip_fiyat = $senet_result + $p;
                $urunListesi[] = $urun; 
               }
            }



            $viewData['fiyat_listesi'] = $urunListesi;









            $viewData['urun'] = $check_id[0];
			$viewData["page"] = "urun/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('urun'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("Urun_sil");
		$this->Urun_model->delete($id);  
        $viewData["page"] = "urun/list";
		$this->load->view('base_view',$viewData);
	}



    public function get_basliklar($urun_id)
    {
         
        if (empty($urun_id) )
        {
            $data = array('status' => 'error', 'message' => 'Ürün Bilgisi Alınamadı..!');
        }
        else
        {
            $renkler = $this->db->get_where('urun_basliklari', array('urun_no' => $urun_id));
            if ( $renkler->num_rows() > 0 )
            {
                $renkList = array();
                foreach ($renkler->result() as $item) {
                    $renkList[] = array('id' => $item->baslik_id, 'renk' => $item->baslik_adi);
                }
                $data = array('status' => 'ok', 'message' => '', 'data' => $renkList);
            }
            else
            {
                $data = array('status' => 'error', 'message' => 'Renk Bulunamadı..!');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }




    public function get_renkler($urun_id)
    {
         
        if (empty($urun_id) )
        {
            $data = array('status' => 'error', 'message' => 'Ürün Bilgisi Alınamadı..!');
        }
        else
        {
            $renkler = $this->db->get_where('urun_renkleri', array('urun_no' => $urun_id));
            if ( $renkler->num_rows() > 0 )
            {
                $renkList = array();
                foreach ($renkler->result() as $item) {
                    $renkList[] = array('id' => $item->renk_id, 'renk' => $item->renk_adi);
                }
                $data = array('status' => 'ok', 'message' => '', 'data' => $renkList);
            }
            else
            {
                $data = array('status' => 'error', 'message' => 'Renk Bulunamadı..!');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("Urun_ekle");
        }else{
            yetki_kontrol("Urun_duzenle");
        }
        $this->form_validation->set_rules('urun_adi',  'urun Adı',  'required'); 
        
        $data['urun_adi']  = escape($this->input->post('urun_adi'));
        $data['urun_aciklama']  = escape($this->input->post('urun_aciklama'));
        $data['urun_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['urun_satis_fiyati']  = escape($this->input->post('urun_satis_fiyati'));
        $data['urun_vade_farki']  = escape($this->input->post('urun_vade_farki'));
      
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Urun_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Urun_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['urun_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
       
            $this->Urun_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('urun/ekle'));
        }
		redirect(site_url('urun'));
	}
}
