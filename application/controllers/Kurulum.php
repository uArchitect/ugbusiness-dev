<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurulum extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul'); 
    } 

    public function index($id = 0,$tag="c1") {
      if($tag == "0"){
 echo "hata";
      }else{
       
        $viewData["tag"] =     $tag;
      

        $query = $this->db
        ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id  = kurulum_data.kurulum_data_siparis_urun_no')
        ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
        ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
        ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
        ->where("kurulum_data.kurulum_data_id",$id)->get("kurulum_data");
        $viewData["kdata"] = $query->result()[0];
 
        $viewData["page"] = "kurulum/tarama";
        $this->load->view('base_view', $viewData);
      }
 
    }

    public function kurulum_list() {
        
      $query = $this->db
      ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id  = kurulum_data.kurulum_data_siparis_urun_no')
      ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
      ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
      ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
      ->get("kurulum_data");
      $viewData["kurulum_data"] = $query->result();
     
      $viewData["page"] = "kurulum/list";
      $this->load->view('base_view', $viewData);

      }


      public function kaydet() {
        
       $control_data = $this->db->where("seri_numarasi",$this->input->post("seri_numarasi"))->get("siparis_urunleri")->result()[0];
       if($control_data){
        $insertData["kurulum_data_siparis_urun_no"] = $control_data->siparis_urun_id;
        $insertData["sorumlu_k_id"] = $this->session->userdata('aktif_kullanici_id');
        $this->db->insert("kurulum_data",$insertData);
        $this->session->set_flashdata('flashSuccess', "Seri numarası başarıyla tanımlanmıştır. Belge / Fotoğraf yükleme işlemini gerçekleştirebilirsiniz.");
       }else{
        $this->session->set_flashdata('flashDanger', "Girmiş olduğunuz seri numarası ile eşleşen bir kayıt bulunamadı. Sistem yöneticiniz ile iletişime geçiniz.");
              
       }
       redirect($_SERVER['HTTP_REFERER']);
  
        }




        public function upload() {
          $json = json_decode(file_get_contents("php://input"), true);
          $base64 = $json['image'] ?? null;
  
          if (!$base64) {
              echo json_encode(['status' => 'error', 'message' => 'Görsel yok']);
              return;
          }
  
          $image_parts = explode(";base64,", $base64);
          if (count($image_parts) !== 2) {
              echo json_encode(['status' => 'error', 'message' => 'Base64 hatalı']);
              return;
          }
  
          $image_base64 = base64_decode($image_parts[1]);
          $filename = str_replace("",".",uniqid('img_', true)) . '.png';
          $file_path = FCPATH . 'uploads/' . $filename;
  
          if (!is_dir(FCPATH . 'uploads')) {
              mkdir(FCPATH . 'uploads', 0777, true);
          }
  
          file_put_contents($file_path, $image_base64);
  
          // Veritabanına kaydet
         $this->db->where("kurulum_data_id",$json['kid'])->update('kurulum_data', [
            $json['tag'] => $filename,
            $json['tag']."_yukleme_tarihi" => date('Y-m-d H:i:s')
          ]);
  
          echo json_encode(['status' => 'success', 'filename' => $filename]);
      }
}
