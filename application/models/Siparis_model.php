<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siparis_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 

    public function get_by_id($id){
      $response = false;
      $this->db->where(["siparis_aktif"=>1]);
      $query = $this->db->where("siparis_id",$id)
      ->select('siparisler.*, merkezler.*, musteriler.*,ulkeler.*, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.*,siparis_onay_adimlari.*,sirket_araclari.*')
      ->from('siparisler')
      ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
      ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
      ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id')
      ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id')
      ->join('ulkeler', 'merkezler.merkez_ulke_id = ulkeler.ulke_id')
      ->join('sirket_araclari', 'sirket_araclari.sirket_arac_id = kurulum_arac_plaka','left')
      ->join(
        '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY onay_tarih DESC) as row_num
          FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
        'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1'
    )
    ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no')
      ->order_by('siparisler.siparis_id', 'ASC')
      ->get();
      if($query && $query->num_rows()){
        $response = $query->result();
      }
      return $response;

 




    }

    public function get_all($where = null,$where2 = null,$where3 = null)
    {
      if($where != null){

        $this->db->where($where);
        if($where2 != null){

          $this->db->where($where2);

          if($where3 != null){

            $this->db->where($where3);
          }

        }
      }
       $this->db->where(["siparisi_olusturan_kullanici !="=>1]);
       $this->db->where(["siparisi_olusturan_kullanici !="=>12]);
       $this->db->where(["siparisi_olusturan_kullanici !="=>11]);
       $this->db->where(["siparisi_olusturan_kullanici !="=>13]);
       $this->db->where(["siparis_aktif"=>1]);
      $query = $this->db
          ->select('siparisler.*,kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id, merkezler.merkez_adi,merkezler.merkez_adresi, musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,musteriler.musteri_sabit_numara, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.*,siparis_onay_adimlari.*')
          ->from('siparisler')
          ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
          ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
          ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id','left')
          ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id','left')
          ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
          ->join(
            '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY onay_tarih DESC) as row_num
              FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
            'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1'
        )
        ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no')
          ->order_by('siparisler.siparis_id', 'DESC')
          ->get();
      return $query->result();
    }


    public function get_all_waiting($where_in, $kullanici_id = null)
    {
     
      if(count($where_in)<=0){
        return [];
      }
      $this->db->where(["siparis_aktif"=>1]);
     
      $query = $this->db->where_in('adim_no',$where_in)
          ->select('siparisler.*,kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,kullanicilar.kullanici_resim, merkezler.merkez_adi,merkezler.merkez_adresi, musteriler.musteri_id,musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,musteriler.musteri_sabit_numara, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.*,siparis_onay_adimlari.*')
          ->from('siparisler')
          ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
          ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
          ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id')
          ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id')
          ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
      
          ->join(
            '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
              FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
            'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1'
        )
        ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no');
      
      // Kullanıcı ID verilmişse, report sayfasındaki mantıkla aynı şekilde kontrol et
      // Report sayfasında: $ara = $hareketler[count($hareketler)-1]->adim_no+1;
      // Sonra: if(array_search("siparis_onay_".$ara, ...)) kontrolü yapılıyor
      // Yani: bir sonraki adım = adim_no + 1, yetki kodu = siparis_onay_{bir_sonraki_adım}
      if($kullanici_id !== null) {
          // Report sayfasındaki mantık: adim_no + 1 = bir sonraki adım, yetki kodu = siparis_onay_{adim_no+1}
          $this->db->where("EXISTS (
              SELECT 1 
              FROM kullanici_yetki_tanimlari 
              WHERE kullanici_yetki_tanimlari.kullanici_id = " . (int)$kullanici_id . "
                AND kullanici_yetki_tanimlari.yetki_kodu = CONCAT('siparis_onay_', siparis_onay_hareketleri.adim_no + 1)
          )");
      }
      
      $query = $this->db->order_by('siparisler.siparis_id', 'DESC')
          ->order_by('adim_no', 'ASC')
          ->get();
      return $query->result();
    }








    public function get_all_products_by_order_id($id)
    {
      $query = $this->db
      ->where("siparis_urunleri.siparis_kodu",$id)
          ->select('siparis_urunleri.*,siparisler.siparisi_olusturan_kullanici,urunler.*,urun_renkleri.*,siparis_hediyeler.*,siparis_urunleri.urun_no as s_urun_no')
          ->from('siparis_urunleri') 
          ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
          ->join('urunler', 'urunler.urun_id = urun_no')
          ->join('urun_renkleri', 'urun_renkleri.renk_id = siparis_urunleri.renk','left')
             ->join('siparis_hediyeler', 'siparis_hediyeler.siparis_hediye_id = siparis_urunleri.hediye_no','left')
          ->order_by('siparis_urunleri.siparis_urun_id', 'ASC')
          ->get();
      return $query->result();
    }


    public function get_all_products($where = null)
    {  $this->db->where(["siparis_urun_aktif"=>1]);
      $query = $this->db
      ->where($where)
          ->select('siparis_urunleri.*,urunler.*,urun_renkleri.*')
          ->from('siparis_urunleri') 
          ->join('urunler', 'urunler.urun_id = urun_no')
          ->join('urun_renkleri', 'urun_renkleri.renk_id = siparis_urunleri.renk','left')
          ->order_by('siparis_urunleri.siparis_urun_id', 'ASC')
          ->get();
      return $query->result();
    }


    public function get_all_actions_by_order_id($id)
    {
      $query = $this->db
      ->where("siparis_no",$id)
                    ->select('siparis_onay_hareketleri.*,kullanicilar.*,siparis_onay_adimlari.*,departmanlar.*')
                    ->from('siparis_onay_hareketleri')  
                    ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no')
                    ->join('kullanicilar', 'kullanicilar.kullanici_id = onay_kullanici_id')
                    ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
                    ->order_by('siparis_onay_hareketleri.siparis_onay_hareket_id', 'ASC')
                    ->get();
      return $query->result();
    }

    public function get_all_steps()
    {
      $query = $this->db
                    ->select('siparis_onay_adimlari.*')
                    ->from('siparis_onay_adimlari')  
                    ->get();
      return $query->result();
    }




    public function insert($data){
		  $this->db->insert('siparisler', $data);    
   
      
	  }

    public function update($id,$data){
      $this->db->where('siparis_id', $id);
      $this->db->update('siparisler', $data);
    }

    public function delete($id){
      $this->db->delete('siparisler', array('siparis_id' => $id));
    }
}