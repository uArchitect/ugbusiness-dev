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
            if($check_id[0]->urun_pesinat_artis_ust_fiyati != 0 && $check_id[0]->urun_pesinat_fiyati != 0){
           
           
                $umexoran = 0;
                $robotxoran = 0;
                $digeroran = 0;

                for ($p = $check_id[0]->urun_pesinat_fiyati; $p <= $check_id[0]->urun_pesinat_artis_ust_fiyati; $p+=$check_id[0]->pesinat_artis_aralik) {
                
                for($v = 20; $v >= 1; $v--){
                    if($v%2 == 1 && $v != 1) continue;
                    
                    $senet_result = (($check_id[0]->urun_satis_fiyati-$p)*(($check_id[0]->urun_vade_farki/12)*$v)+($check_id[0]->urun_satis_fiyati-$p)) ;


                $urun = new stdClass();
                $urun->pesinat_fiyati = $p;
                $urun->vade = $v;
                $urun->senet = $senet_result;
                $urun->aylik_taksit_tutar = $senet_result / $v;
                $urun->toplam_dip_fiyat = $senet_result + $p;
                $urun->toplam_dip_fiyat_yuvarlanmis = floor(($senet_result + $p) / 5000) * 5000;
                $urun->toplam_dip_fiyat_yuvarlanmis_satisci = (floor(($senet_result + $p) / 5000) * 5000)-($check_id[0]->satis_pazarlik_payi);
               if($check_id[0]->urun_vadeli_umex_takas_fiyat != 0){
                if($p == $check_id[0]->urun_pesinat_fiyati && $v == 20){
                    $umexoran = ($senet_result + $p) / $check_id[0]->urun_vadeli_umex_takas_fiyat; 
                    $robotxoran = ($senet_result + $p) / $check_id[0]->urun_vadeli_robotix_takas_fiyat; 
                    $digeroran = ($senet_result + $p) / $check_id[0]->urun_vadeli_diger_takas_fiyat; 
                 }
                 $urun->vadeli_umex_degisim = ($senet_result + $p) /  ($umexoran);
                 $urun->vadeli_robotx_degisim = ($senet_result + $p) /  ($robotxoran);
                 $urun->vadeli_diger_degisim = ($senet_result + $p) /  ($digeroran);
               }else{
                $urun->vadeli_umex_degisim    = 0;
                $urun->vadeli_robotx_degisim  = 0;
                $urun->vadeli_diger_degisim   = 0;
               }
               
                $urunListesi[] = $urun; 
               }
            }
        }

$viewData['secilen_urun'] = $id;

            $viewData['fiyat_listesi'] = $urunListesi;




            $viewData['kullanicilar'] = $this->db
            ->query("SELECT * FROM `kullanicilar` WHERE (`kullanici_departman_id`= 12 or `kullanici_departman_id`= 17 or `kullanici_departman_id`= 18 or `kullanici_id`= 2 or `kullanici_id`= 9) and kullanici_aktif = 1 order by kullanici_ad_soyad asc")->result();
            $viewData['limitkullanicilar'] = $this->db->order_by("kullanici_ad_soyad","asc")->where("kullanici_aktif",1)->where("kullanici_limit_kontrol",1)->get("kullanicilar")->result();






            $viewData['urun'] = $check_id[0];
			$viewData["page"] = "urun/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('urun'));
        }
 
	}








    public function satici_limit($id = '')
	{  
        yetki_kontrol("siparis_onay_1");
        if(aktif_kullanici()->kullanici_id == 1341){
            echo "YETKİSİZ ERİŞİM";return;
        }
		$check_id = $this->Urun_model->get_by_id($id); 

        
        if($check_id){  


            $fiyatlar = [];
            if($check_id[0]->urun_pesinat_artis_ust_fiyati != 0 && $check_id[0]->urun_pesinat_fiyati != 0){
            for ($p = $check_id[0]->urun_pesinat_fiyati; $p <= $check_id[0]->urun_pesinat_artis_ust_fiyati; $p+=$check_id[0]->pesinat_artis_aralik) {
                
                for($v = 20; $v >= 1; $v--){
                    if($v%2 == 1 && $v != 1) continue;
                    
                    $senet_result = (($check_id[0]->urun_satis_fiyati-$p)*(($check_id[0]->urun_vade_farki/12)*$v)+($check_id[0]->urun_satis_fiyati-$p)) ;


                $urun = new stdClass();
                $urun->pesinat_fiyati = $p;
                $urun->vade = $v;
                $urun->senet = $senet_result;
                $urun->aylik_taksit_tutar = $senet_result / $v;
                $urun->toplam_dip_fiyat = $senet_result + $p;
                $urun->toplam_dip_fiyat_yuvarlanmis = floor(($senet_result + $p) / 5000) * 5000;
                $urun->toplam_dip_fiyat_yuvarlanmis_satisci = (floor(($senet_result + $p) / 5000) * 5000)-($check_id[0]->satis_pazarlik_payi);
                $urunListesi[] = $urun; 
               }
            }
        }

$viewData['secilen_urun'] = $id;

            $viewData['fiyat_listesi'] = $urunListesi;





 
			$viewData["page"] = "urun/satici_limitler"; 
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
        $data['urun_satis_fiyati']              = preg_replace('/\D/', '', escape($this->input->post('urun_satis_fiyati')));
        $data['urun_vade_farki']                = escape($this->input->post('urun_vade_farki'));
        $data['urun_pesinat_fiyati']            = preg_replace('/\D/', '', escape($this->input->post('urun_pesinat_fiyati')));
        $data['pesinat_artis_aralik']           = preg_replace('/\D/', '', escape($this->input->post('pesinat_artis_aralik')));
        $data['urun_pesinat_artis_ust_fiyati']  = preg_replace('/\D/', '', escape($this->input->post('urun_pesinat_artis_ust_fiyati')));
        $data['satis_pazarlik_payi']            = preg_replace('/\D/', '', escape($this->input->post('satis_pazarlik_payi')));
       
        $data['urun_nakit_umex_takas_fiyat']            = preg_replace('/\D/', '', escape($this->input->post('nakit_umex_takas_fiyat')));
        $data['urun_vadeli_umex_takas_fiyat']            = preg_replace('/\D/', '', escape($this->input->post('vadeli_umex_takas_fiyat')));
      
        $data['urun_nakit_robotix_takas_fiyat']            = preg_replace('/\D/', '', escape($this->input->post('nakit_robotix_takas_fiyat')));
        $data['urun_vadeli_robotix_takas_fiyat']            = preg_replace('/\D/', '', escape($this->input->post('vadeli_robotix_takas_fiyat')));
      
        $data['urun_nakit_diger_takas_fiyat']            = preg_replace('/\D/', '', escape($this->input->post('nakit_diger_takas_fiyat')));
        $data['urun_vadeli_diger_takas_fiyat']            = preg_replace('/\D/', '', escape($this->input->post('vadeli_diger_takas_fiyat')));
      

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Urun_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Urun_model->update($id,$data);
                redirect(site_url("urun/duzenle/$id"));
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
