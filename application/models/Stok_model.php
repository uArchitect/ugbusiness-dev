<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_cihaz_stok_tanimlari($where=null)
    { if($where!=null){
      $this->db->where($where);
    }
      $this->db->select('cihaz_stok_tanimlari.*,urunler.*, stok_tanimlari.*');
      $this->db->from('cihaz_stok_tanimlari');
      $this->db->join('urunler', 'urunler.urun_id = cihaz_stok_tanimlari.urun_fg_id');
      $this->db->join('stok_tanimlari', 'stok_tanimlari.stok_tanim_id = cihaz_stok_tanimlari.stok_fg_id'); 
      $this->db->order_by('cihaz_stok_sira_no', 'ASC'); 
      $query = $this->db->get();
      
      return $query->result();
    }


    public function get_stok_genel_bakis() {

      //26082024 güncelleme ***************
     /* $sql = "
          WITH stok_hareketleri_toplam AS (
              SELECT 
                  s.stok_tanim_kayit_id,
                  COALESCE(SUM(sh.giris_miktar), 0) AS toplam_giris_miktar,
                  COALESCE(SUM(sh.cikis_miktar), 0) AS toplam_cikis_miktar
              FROM 
                  stoklar s
              INNER JOIN 
                  stok_hareketleri sh ON s.stok_id = sh.stok_fg_id
              GROUP BY 
                  s.stok_tanim_kayit_id
          )
          SELECT 
          sk.*, sb.*,
              COALESCE(th.toplam_giris_miktar, 0) AS giris_stok,
              COALESCE(th.toplam_cikis_miktar, 0) AS cikis_stok,
              COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) AS toplam_stok
          FROM 
              stok_tanimlari sk
          LEFT JOIN 
              stok_hareketleri_toplam th ON sk.stok_tanim_id = th.stok_tanim_kayit_id
              LEFT JOIN 
              stok_birimleri sb ON sk.stok_birim_fg_id = sb.stok_birim_id
      ";
*/
//26082024 güncelleme ***************
      $sql = "WITH stok_hareketleri_toplam AS (
    SELECT 
        s.stok_tanim_kayit_id,
        COALESCE(SUM(sh.giris_miktar), 0) AS toplam_giris_miktar,
        COALESCE(SUM(sh.cikis_miktar), 0) AS toplam_cikis_miktar
    FROM 
        stoklar s
    INNER JOIN 
        stok_hareketleri sh ON s.stok_id = sh.stok_fg_id
    GROUP BY 
        s.stok_tanim_kayit_id
)
SELECT 
    sk.*, 
    sb.*,
    COALESCE(th.toplam_giris_miktar, 0) AS giris_stok,
    COALESCE(th.toplam_cikis_miktar, 0) AS cikis_stok,
    COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) AS toplam_stok,
    CASE
        WHEN COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) < sk.stok_kritik_sayi 
             AND sk.stok_kritik_uyari = 1 THEN 'stok_uyarisi'
        ELSE ''
    END AS uyari_ver
FROM 
    stok_tanimlari sk
LEFT JOIN 
    stok_hareketleri_toplam th ON sk.stok_tanim_id = th.stok_tanim_kayit_id
LEFT JOIN 
    stok_birimleri sb ON sk.stok_birim_fg_id = sb.stok_birim_id;

      ";


      

      $query = $this->db->query($sql);
      return $query->result();
  }






 
    public function get_stok_tanimlari($where=null)
    {
      if($where!=null){
        $this->db->where($where);
      }
     $this->db->select('st.*,ust_grup.stok_tanim_ad AS ust_grup_ad, 
      COALESCE(SUM(CASE WHEN sh.stok_cikis_yapildi = 0 THEN 1 ELSE 0 END), 0) AS toplam_stok, 
      COALESCE(SUM(CASE WHEN sh.stok_cikis_yapildi = 1 THEN 1 ELSE 0 END), 0) AS cikis_stok, 
      COALESCE(COUNT(sh.stok_id), 0) AS giris_stok')
      ->from('stok_tanimlari st')
      ->join('stoklar sh', 'st.stok_tanim_id = sh.stok_tanim_kayit_id', 'left')
      ->join('stok_tanimlari ust_grup', 'st.stok_tanim_ust_grup_id = ust_grup.stok_tanim_id', 'left')
      ->order_by('st.stok_tanim_id','ASC')
      ->group_by('st.stok_tanim_ad, ust_grup.stok_tanim_ad');
 
      return $this->db->get()->result();

 
    }


    public function stok_kayitlari_all($where=null,$like=null)
    {
      if ($where != null) {
        $this->db->where($where);
    }
    if ($like != null) {
      $this->db->like('stok_seri_kod', $like, 'both');
  }
    $this->db->select('sh.*,  st.stok_tanim_id, st.stok_tanim_ad, st.stok_tanim_aciklama, spr.seri_numarasi, ust_grup.stok_tanim_ad AS ust_grup_ad');
    $this->db->from('stoklar sh');
    $this->db->join('stok_tanimlari st', 'sh.stok_tanim_kayit_id = st.stok_tanim_id', 'left');
    $this->db->join('stok_tanimlari ust_grup', 'st.stok_tanim_ust_grup_id = ust_grup.stok_tanim_id', 'left');
    $this->db->join('siparis_urunleri spr', 'spr.seri_numarasi = sh.tanimlanan_cihaz_seri_numarasi', 'left');
    $this->db->order_by('sh.stok_id', 'DESC');
    $query = $this->db->get();
    $stoklar = $query->result();

    return $stoklar;

 
    }



    
    public function stok_hareketleri_all($where=null)
    {
      if ($where != null) {
        $this->db->where($where);
    }
    $this->db->select('sh.*,st.stok_tanim_ad,scb.stok_cikis_birim_adi,k.kullanici_ad_soyad');
    $this->db->from('stok_hareketleri sh');
    $this->db->join('stoklar s', 's.stok_id = sh.stok_fg_id');
    $this->db->join('stok_tanimlari st', 's.stok_tanim_kayit_id = st.stok_tanim_id'); 
    $this->db->join('stok_cikis_birimleri scb', 'sh.stok_cikis_birim_fg_id = scb.stok_cikis_birim_id ','left'); 
    $this->db->join('kullanicilar k', 'sh.hareket_kaydeden_kullanici = k.kullanici_id'); 
    $this->db->order_by('sh.stok_hareket_id ', 'ASC');
    $query = $this->db->get(); 

    return $query->result();

 
    }

    public function get_stok_kayitlari($where=null,$like=null)
    {
      $this->db->select('sh.*, st.*, spr.seri_numarasi, ust_grup.stok_tanim_ad AS ust_grup_ad');
      $this->db->from('stoklar sh');
      $this->db->join('stok_tanimlari st', 'sh.stok_tanim_kayit_id = st.stok_tanim_id', 'left');
      $this->db->join('stok_tanimlari ust_grup', 'st.stok_tanim_ust_grup_id = ust_grup.stok_tanim_id', 'left');
      $this->db->join('siparis_urunleri spr', 'spr.seri_numarasi = sh.tanimlanan_cihaz_seri_numarasi', 'left');
      
      if ($where != null) {
        // WHERE koşullarını tablo alias'ı ile düzelt
        foreach ($where as $key => $value) {
          // Eğer key'de tablo alias'ı yoksa, sh. ekle
          if (strpos($key, '.') === false) {
            $this->db->where('sh.' . $key, $value);
          } else {
            $this->db->where($key, $value);
          }
        }
      }
      if ($like != null) {
        $this->db->like('sh.stok_seri_kod', $like, 'both');
      }
      
      $this->db->order_by('sh.stok_id', 'DESC');
      $query = $this->db->get();
      $stoklar = $query->result();
      
      // Eğer WHERE koşulu varsa ve sadece tek bir kayıt aranıyorsa, sirala_stoklar'ı atla
      // Çünkü sirala_stoklar sadece hiyerarşik yapıyı sıralamak için kullanılıyor
      if ($where != null && isset($where['stok_seri_kod'])) {
        // Seri numarası ile arama yapılıyorsa, direkt sonucu döndür
        return $stoklar;
      }

    return $this->sirala_stoklar($stoklar);

 
    }

    private function sirala_stoklar($stoklar, $parent_id = 0) {
      $result = [];
      foreach ($stoklar as $stok) {
          if ($stok->stok_ust_grup_kayit_no == $parent_id) {
              $result[] = $stok;
              $children = $this->sirala_stoklar($stoklar, $stok->stok_id);
              $result = array_merge($result, $children);
          }
      }
      return $result;
  }

  public function add_stok_hareket($stok_hareket_data)
    {
      $this->db->insert("stok_hareketleri",$stok_hareket_data);
      return $this->db->insert_id();
    }

    public function add_stok($stok_data)
    {
      $this->db->insert("stoklar",$stok_data);
      return $this->db->insert_id();
    }
    public function update_stok($stok_id,$stok_data)
    {
      $this->db->where(["stok_id"=>$stok_id]);
      $this->db->update("stoklar",$stok_data);
      return true;
    }
}