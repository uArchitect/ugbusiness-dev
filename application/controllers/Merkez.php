<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merkez extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Merkez_model'); 
        $this->load->model('Musteri_model'); 
        $this->load->model('Sehir_model'); 
        $this->load->model('Ilce_model');   $this->load->model('Kullanici_model'); 
       
        date_default_timezone_set('Europe/Istanbul');
    }
    public function kargo_yazdir($id)
	{
         
        $data = $this->Merkez_model->get_by_id($id); 
      
        $viewData["alici"] = $data;
		$this->load->view('baslik/print_kargo/main_content.php',$viewData);
	}
	public function index($siparis_uyari = 0,$merkez_ad_uyari = "")
	{
        yetki_kontrol("merkezleri_goruntule");
        if($merkez_ad_uyari == ""){
            $data = $this->Merkez_model->get_all(); 
        }else{
            $data = $this->Merkez_model->get_all(["merkez_adi" => "#NULL#"],["merkez_adresi" => ""]); 
        }
       
		$viewData["merkezler"] = $data;

           $viewData["siparis_uyari"] = $siparis_uyari;
         
       

		$viewData["page"] = "merkez/list";
		$this->load->view('base_view',$viewData);
	}

	public function add($yetkili_id = 0)
	{   
        yetki_kontrol("merkez_ekle");
		$viewData["page"] = "merkez/form";

        $ulke_data = $this->Sehir_model->get_all_ulkeler();    
		$viewData["ulkeler"] = $ulke_data;
        $musteriler = $this->Musteri_model->get_all(); 
        $viewData['musteriler'] =  $musteriler;

        $viewData["secilen_musteri"] = 0;
        if($yetkili_id != 0){
            $viewData["secilen_musteri"] = $yetkili_id;
            
        }
            

        $il_data = $this->Sehir_model->get_all();    
		$viewData["sehirler"] = $il_data;

        $ilce_data = $this->Ilce_model->get_all();    
		$viewData["ilceler"] = $ilce_data;

		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("merkez_duzenle");
		$check_id = $this->Merkez_model->get_by_id($id); 
        if($check_id){  
            $viewData["secilen_musteri"] = $check_id->merkez_yetkili_id;
            
            $ulke_data = $this->Sehir_model->get_all_ulkeler();    
            $viewData["ulkeler"] = $ulke_data;
            
            $musteriler = $this->Musteri_model->get_all(); 
            $viewData['musteriler'] =  $musteriler;

            $il_data = $this->Sehir_model->get_all();    
            $viewData["sehirler"] = $il_data;
    
            $ilce_data = $this->Ilce_model->get_all(["ilceler.sehir_id"=>$check_id->merkez_il_id]);    
            $viewData["ilceler"] = $ilce_data;

            $viewData['merkez'] = $check_id;
			$viewData["page"] = "merkez/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('merkez'));
        }
 
	}

    public function profile($id = '')
	{  
        yetki_kontrol("merkez_duzenle");
		$check_id = $this->Merkez_model->get_by_id($id); 
        if($check_id){  
            $viewData['merkez'] = $check_id[0];
            $viewData["secilen_musteri"] = 0;
            $merkezler = $this->Merkez_model->get_all(["merkez_yetkili_id"=>$id]);    
            $viewData["merkezler"] = $merkezler;
    

			$viewData["page"] = "merkez/profil"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('merkez'));
        }
 
	}


    public function delete($id)
	{     
        yetki_kontrol("merkez_sil");
		$this->Merkez_model->delete($id);  
        $viewData["page"] = "merkez/list";
		$this->load->view('base_view',$viewData);
	}

    public function pre_up($str){
        $str = str_replace('i', 'İ', $str);
        $str = str_replace('ı', 'I', $str);
        return $str;
    }
  

	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("merkez_ekle");
        }else{
            yetki_kontrol("merkez_duzenle");
        }
      
        $data['merkez_adi']     =  mb_strtoupper($this->pre_up(escape($this->input->post('merkez_adi'))), 'UTF-8');
        $data['merkez_adresi']  = escape($this->input->post('merkez_adresi'));
        $data['merkez_il_id']   = escape($this->input->post('merkez_il_id'));
        $data['merkez_ilce_id'] = escape($this->input->post('merkez_ilce_id')); 
        $data['merkez_ulke_id'] = escape($this->input->post('ulke_id')); 
       
       $data['merkez_yetkili_id'] = escape($this->input->post('merkez_yetkili_id')); 
      
     

        
        if (!empty($id)) {
            $check_id = $this->Merkez_model->get_by_id($id);
            if($check_id){
                unset($data['id']);

                $kulcheck_id = $this->Kullanici_model->get_all(["kullanici_id"=>aktif_kullanici()->kullanici_id]); 
                if($kulcheck_id[0]->kullanici_id != 1){
                    $data['merkez_kayit_guncelleme_notu'] = $kulcheck_id[0]->kullanici_ad_soyad." - ".date("d.m.Y H:i"); 
               
                

                    $data['merkez_guncelleme_tarihi'] = date('Y-m-d H:i:s');
                   
                }
                $this->Merkez_model->update($id,$data);
            }
        }elseif(empty($id)){
             $this->Merkez_model->insert($data);
  

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('merkez/ekle'));
        }

        if($this->input->post('sipariskod') != ""){
  $data['redirect_url'] = site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$this->input->post('sipariskod')."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")));
        }else{
  $data['redirect_url'] = site_url('merkez');
        }
      
        // Yönlendirme scriptini view'a aktar
        $this->load->view('musteri/updatewindow.php', $data);
        
      
	}












    public function merkezler_ajax() { 
		yetki_kontrol("merkezleri_goruntule");
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        if(!empty($search)) {
            $this->db->like('musteri_ad', $search);  
			 $this->db->or_like('musteri_iletisim_numarasi', $search); 
			 $this->db->or_like('merkez_adresi', $search); 
			 $this->db->or_like('merkez_adi', $search); 
             $this->db->or_like('sehir_adi', $search); 
             $this->db->or_like('ilce_adi', $search); 
        }

 


        $query = $this->db
        ->join('musteriler', 'musteriler.musteri_id = merkez_yetkili_id')
         ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
         ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
        ->order_by('merkez_id', 'ASC')
        ->order_by($order, $dir)
        ->limit($limit, $start)
        ->get("merkezler");

 
                      

        $data = [];
        foreach ($query->result() as $row) {



  

  
            $data[] = [ 

                '
              <a type="button" href="https://ugbusiness.com.tr/merkez/duzenle/'.$row->merkez_id.'" class="btn btn-xs btn-warning" style="font-size: 12px!important;font-weight:normal"><i class="fa fa-pen"></i> Düzenle</a>
              <a type="button" target="_blank" href="https://ugbusiness.com.tr/merkez/kargo_yazdir/'.$row->merkez_id.'" class="btn btn-xs btn-primary" style="font-size: 12px!important;font-weight:normal"><i class="fa fa-print"></i> Kargo Etiket</a>
              ',

              "<span style='font-weight:normal'>".$row->merkez_adi." / ". $row->musteri_ad."</span>",
   

              "<span style='font-weight:normal'>".formatTelephoneNumber($row->musteri_iletisim_numarasi)."</span>",
           
            '<i class="fas fa-map-marker-alt" style="margin-right:2px "></i> '.$row->merkez_adresi. " <span style='font-weight:normal'>".$row->sehir_adi." / ".$row->ilce_adi."</span>",
 
			];
        }
       
        $totalData = $this->db->count_all('merkezler');
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
