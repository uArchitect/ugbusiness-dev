<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_chat extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        ugajans_sess_control();
        date_default_timezone_set('Europe/Istanbul');
    }
    
    /**
     * Çevrimiçi kullanıcıları getir (sadece bilgi amaçlı - chat header'da gösterilecek)
     */
    public function get_users()
    {
        // Tüm aktif kullanıcıları getir
        $kullanicilar = $this->db
            ->select('ugajans_kullanicilar.ugajans_kullanici_id, ugajans_kullanicilar.ugajans_kullanici_ad_soyad as ad_soyad, ugajans_kullanicilar.ugajans_kullanici_gorsel as gorsel')
            ->from('ugajans_kullanicilar')
            ->where('ugajans_kullanicilar.ugajans_kullanici_aktif', 1)
            ->order_by('ugajans_kullanicilar.ugajans_kullanici_ad_soyad', 'ASC')
            ->get()
            ->result();
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'users' => $kullanicilar
            ]));
    }
    
    /**
     * Genel toplu chat mesajlarını getir (alan_kullanici_id NULL olanlar)
     */
    public function get_messages()
    {
        // Son 100 mesajı getir (performans için)
        $mesajlar = $this->db
            ->select('ugajans_canli_chat.*, 
                     gonderen.ugajans_kullanici_ad_soyad as gonderen_ad,
                     gonderen.ugajans_kullanici_gorsel as gonderen_gorsel')
            ->from('ugajans_canli_chat')
            ->join('ugajans_kullanicilar as gonderen', 'gonderen.ugajans_kullanici_id = ugajans_canli_chat.gonderen_kullanici_id', 'left')
            ->where('ugajans_canli_chat.silindi', 0)
            ->where('ugajans_canli_chat.alan_kullanici_id IS NULL') // Sadece genel mesajlar
            ->order_by('ugajans_canli_chat.olusturma_tarihi', 'DESC')
            ->limit(100)
            ->get()
            ->result();
        
        // Mesajları ters çevir (en eski en üstte)
        $mesajlar = array_reverse($mesajlar);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'messages' => $mesajlar
            ]));
    }
    
    /**
     * Genel toplu chat'e mesaj gönder (alan_kullanici_id NULL)
     */
    public function send_message()
    {
        $aktif_kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
        $mesaj_icerik = $this->input->post('message');
        
        if(empty($mesaj_icerik) || trim($mesaj_icerik) == '') {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Mesaj içeriği gereklidir.'
                ]));
            return;
        }
        
        // Mesaj içeriğini temizle ve kontrol et
        $mesaj_icerik = trim($mesaj_icerik);
        if(strlen($mesaj_icerik) > 1000) {
            $mesaj_icerik = substr($mesaj_icerik, 0, 1000);
        }
        
        $data = [
            'gonderen_kullanici_id' => $aktif_kullanici_id,
            'alan_kullanici_id' => NULL, // Genel mesaj için NULL
            'mesaj_icerik' => escape($mesaj_icerik),
            'mesaj_tipi' => 'text',
            'okundu' => 0,
            'silindi' => 0,
            'olusturma_tarihi' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('ugajans_canli_chat', $data);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'Mesaj gönderildi.',
                'chat_id' => $this->db->insert_id()
            ]));
    }
    
    /**
     * Okunmamış mesaj sayısını getir (toplu chat için kullanılmıyor ama badge için tutuluyor)
     */
    public function get_unread_count()
    {
        // Toplu chat'te okunmamış mesaj sayısı göstermiyoruz
        // Ama yeni mesaj geldiğinde badge gösterebiliriz
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'count' => 0
            ]));
    }
}
