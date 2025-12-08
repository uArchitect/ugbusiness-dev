<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arac_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_all()
    {
      $query = $this->db->order_by('sirket_arac_id', 'ASC')->where("sirket_arac_aktif",1)->get("sirket_araclari");
      return $query->result();
    }

    public function delete($arac_id)
    {
      $this->db->where(["arac_id"=>$bakim_id]);
      $this->db->delete("araclar");
      return true;
    }



    public function get_all_araclar($where = null,$orwhere = null)
    {
      if($where != null){
        $this->db->where($where);
        
      }
      if($orwhere != null){
        $this->db->or_where($orwhere);
        
      }

      $query = $this->db  
      ->select("araclar.*,kullanicilar.*,ik.kullanici_ad_soyad as ikinci_surucu")
      ->from('araclar')->order_by("arac_id","asc")
      ->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left')
      ->join('kullanicilar ik', 'ik.kullanici_id = araclar.arac_surucu_id_2', 'left')
      ->get();
      return $query->result();
    }
    public function update_arac($arac_id,$arac_data)
    {
      $this->db->where(["arac_id"=>$arac_id]);
      $this->db->update("araclar",$arac_data);
      return true;
    }



    public function get_all_bakimlar($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_bakim_id', 'ASC')->get("arac_bakimlar");
      return $query->result();
    }
    public function add_bakim($bakim_data)
    {
      $this->db->insert("arac_bakimlar",$bakim_data);
      return true;
    }
    public function update_bakim($bakim_id,$bakim_data)
    {
      $this->db->where(["arac_bakim_id"=>$bakim_id]);
      $this->db->update("arac_bakimlar",$bakim_data);
      return true;
    }
    public function delete_bakim($bakim_id)
    {
      $this->db->where(["arac_bakim_id"=>$bakim_id]);
      $this->db->delete("arac_bakimlar");
      return true;
    }



    public function get_all_sigortalar($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_sigorta_id', 'ASC')->get("arac_sigortalar");
      return $query->result();
    }
    public function add_sigorta($sigorta_data)
    {
      $this->db->insert("arac_sigortalar",$sigorta_data);
      return true;
    }
    public function update_sigorta($sigorta_id,$sigorta_data)
    {
      $this->db->where(["arac_sigorta_id"=>$sigorta_id]);
      $this->db->update("arac_sigortalar",$sigorta_data);
      return true;
    }
    public function delete_sigorta($sigorta_id)
    {
      $this->db->where(["arac_sigorta_id"=>$sigorta_id]);
      $this->db->delete("arac_sigortalar");
      return true;
    }


    public function add_muayene($muayene_data)
    {
      $this->db->insert("arac_muayeneler",$muayene_data);
      return true;
    }
    public function update_muayene($muayene_id,$muayene_data)
    {
      $this->db->where(["arac_muayene_id"=>$muayene_id]);
      $this->db->update("arac_muayeneler",$muayene_data);
      return true;
    }



    public function get_all_km($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_km_id', 'DESC')->get("arac_kmler");
      return $query->result();
    }
    public function add_km($km_data)
    {
      $this->db->insert("arac_kmler",$km_data);
      return true;
    }
    public function update_km($arac_km_id,$km_data)
    {
      $this->db->where(["arac_km_id"=>$arac_km_id]);
      $this->db->update("arac_kmler",$km_data);
      return true;
    }
    public function delete_km($arac_km_id)
    {
      $this->db->where(["arac_km_id"=>$arac_km_id]);
      $this->db->delete("arac_kmler");
      return true;
    }




    public function add_lastik($lastik_data)
    {
      $this->db->insert("arac_lastikler",$lastik_data);
      return true;
    }


    public function get_all_muayeneler($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_muayene_id', 'ASC')->get("arac_muayeneler");
      return $query->result();
    }
    public function get_all_kaskolar($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_kasko_id', 'ASC')->get("arac_kaskolar");
      return $query->result();
    }
    public function add_kasko($kasko_data)
    {
      $this->db->insert("arac_kaskolar",$kasko_data);
      return true;
    }
    public function update_kasko($kasko_id,$kasko_data)
    {
      $this->db->where(["arac_kasko_id"=>$kasko_id]);
      $this->db->update("arac_kaskolar",$kasko_data);
      return true;
    }
    public function delete_kasko($kasko_id)
    {
      $this->db->where(["arac_kasko_id"=>$kasko_id]);
      $this->db->delete("arac_kaskolar");
      return true;
    }


    public function delete_muayene($muayene_id)
    {
      $this->db->where(["arac_muayene_id"=>$muayene_id]);
      $this->db->delete("arac_muayeneler");
      return true;
    }

    /**
     * Araç sahiplerinin aylık ortalama kilometre değerlerini hesaplar
     * @param int $ay_sayisi Hesaplanacak ay sayısı (varsayılan: 12)
     * @param array $secilen_kullanicilar Seçili kullanıcı ID'leri (boş ise tümü)
     * @return array Aylık ortalama kilometre verileri
     */
    public function get_aylik_ortalama_kilometre($ay_sayisi = 12, $secilen_kullanicilar = [])
    {
        try {
            // Ay sayısı kontrolü
            if ($ay_sayisi < 1 || $ay_sayisi > 24) {
                $ay_sayisi = 12;
            }
            
            // Tüm araç sahiplerini al (arac_surucu_id)
            $this->db->select('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
            $this->db->from('araclar');
            $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left');
            $this->db->where('araclar.arac_surucu_id >', 0);
            
            // Eğer kullanıcı seçimi yapıldıysa filtrele
            if (!empty($secilen_kullanicilar) && is_array($secilen_kullanicilar)) {
                $secilen_kullanicilar = array_map('intval', $secilen_kullanicilar);
                $this->db->where_in('araclar.arac_surucu_id', $secilen_kullanicilar);
            }
            
            $this->db->group_by('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
            $arac_sahipler = $this->db->get()->result();

            if (!$arac_sahipler) {
                return [];
            }

            $sonuclar = [];
            $aylar = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 
                      'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];

            // Belirtilen ay sayısı için hesaplama yap
            for ($ay_no = 1; $ay_no <= $ay_sayisi; $ay_no++) {
                $ay_baslangic = date('Y-m-01 00:00:00', strtotime("-$ay_no months"));
                $ay_bitis = date('Y-m-t 23:59:59', strtotime("-$ay_no months"));
                $ay_adi = $aylar[date('n', strtotime($ay_baslangic)) - 1];
                $ay_yil = date('Y-m', strtotime($ay_baslangic));

                $ay_verileri = [
                    'ay_no' => $ay_no,
                    'ay_adi' => $ay_adi,
                    'ay_yil' => $ay_yil,
                    'arac_sahipler' => []
                ];

                foreach ($arac_sahipler as $sahip) {
                    if (empty($sahip->arac_surucu_id)) continue;

                    // Bu araç sahibinin araçlarını al
                    $this->db->select('arac_id, arac_plaka');
                    $this->db->from('araclar');
                    $this->db->where('arac_surucu_id', $sahip->arac_surucu_id);
                    $araclar = $this->db->get()->result();

                    if (!$araclar) continue;

                    $toplam_km_farki = 0;
                    $arac_sayisi = 0;

                    foreach ($araclar as $arac) {
                        // Ay başındaki ilk km kaydı
                        $this->db->select('arac_km_deger');
                        $this->db->from('arac_kmler');
                        $this->db->where('arac_tanim_id', $arac->arac_id);
                        $this->db->where('arac_km_kayit_tarihi >=', $ay_baslangic);
                        $this->db->where('arac_km_kayit_tarihi <=', $ay_bitis);
                        $this->db->order_by('arac_km_kayit_tarihi', 'ASC');
                        $this->db->limit(1);
                        $ay_basi_km = $this->db->get()->row();

                        // Ay sonundaki son km kaydı
                        $this->db->select('arac_km_deger');
                        $this->db->from('arac_kmler');
                        $this->db->where('arac_tanim_id', $arac->arac_id);
                        $this->db->where('arac_km_kayit_tarihi >=', $ay_baslangic);
                        $this->db->where('arac_km_kayit_tarihi <=', $ay_bitis);
                        $this->db->order_by('arac_km_kayit_tarihi', 'DESC');
                        $this->db->limit(1);
                        $ay_sonu_km = $this->db->get()->row();

                        if ($ay_basi_km && $ay_sonu_km && isset($ay_basi_km->arac_km_deger) && isset($ay_sonu_km->arac_km_deger)) {
                            $km_farki = floatval($ay_sonu_km->arac_km_deger) - floatval($ay_basi_km->arac_km_deger);
                            if ($km_farki > 0) {
                                $toplam_km_farki += $km_farki;
                                $arac_sayisi++;
                            }
                        }
                    }

                    $ortalama_km = $arac_sayisi > 0 ? round($toplam_km_farki / $arac_sayisi, 2) : 0;

                    $ay_verileri['arac_sahipler'][] = [
                        'kullanici_id' => intval($sahip->arac_surucu_id),
                        'kullanici_ad_soyad' => $sahip->kullanici_ad_soyad ? $sahip->kullanici_ad_soyad : 'Bilinmeyen',
                        'ortalama_km' => $ortalama_km,
                        'arac_sayisi' => $arac_sayisi,
                        'toplam_km_farki' => round($toplam_km_farki, 2)
                    ];
                }

                $sonuclar[] = $ay_verileri;
            }

            return $sonuclar;
        } catch (Exception $e) {
            log_message('error', 'Arac_model::get_aylik_ortalama_kilometre hatası: ' . $e->getMessage());
            return [];
        }
    }


    public function get_arac_sahipler_guncel_km($secilen_kullanicilar = [])
    {
        try {
            $this->db->select('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
            $this->db->from('araclar');
            $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left');
            $this->db->where('araclar.arac_surucu_id >', 0);
            
            if (!empty($secilen_kullanicilar) && is_array($secilen_kullanicilar)) {
                $secilen_kullanicilar = array_map('intval', $secilen_kullanicilar);
                $this->db->where_in('araclar.arac_surucu_id', $secilen_kullanicilar);
            }
            
            $this->db->group_by('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
            $arac_sahipler = $this->db->get()->result();

            if (!$arac_sahipler) {
                return [];
            }

            $sonuclar = [];

            foreach ($arac_sahipler as $sahip) {
                if (empty($sahip->arac_surucu_id)) continue;

                $this->db->select('arac_id, arac_plaka');
                $this->db->from('araclar');
                $this->db->where('arac_surucu_id', $sahip->arac_surucu_id);
                $araclar = $this->db->get()->result();

                if (!$araclar) continue;

                $toplam_guncel_km = 0;
                $arac_sayisi = 0;
                $arac_detaylari = [];

                foreach ($araclar as $arac) {
                    $this->db->select('arac_km_deger, arac_km_kayit_tarihi');
                    $this->db->from('arac_kmler');
                    $this->db->where('arac_tanim_id', $arac->arac_id);
                    $this->db->order_by('arac_km_kayit_tarihi', 'DESC');
                    $this->db->limit(1);
                    $guncel_km = $this->db->get()->row();

                    if ($guncel_km && isset($guncel_km->arac_km_deger)) {
                        $toplam_guncel_km += floatval($guncel_km->arac_km_deger);
                        $arac_sayisi++;
                        $arac_detaylari[] = [
                            'arac_id' => $arac->arac_id,
                            'arac_plaka' => $arac->arac_plaka,
                            'guncel_km' => floatval($guncel_km->arac_km_deger),
                            'son_guncelleme' => $guncel_km->arac_km_kayit_tarihi
                        ];
                    }
                }

                $ortalama_guncel_km = $arac_sayisi > 0 ? round($toplam_guncel_km / $arac_sayisi, 2) : 0;

                $sonuclar[$sahip->arac_surucu_id] = [
                    'kullanici_id' => intval($sahip->arac_surucu_id),
                    'kullanici_ad_soyad' => $sahip->kullanici_ad_soyad ? $sahip->kullanici_ad_soyad : 'Bilinmeyen',
                    'ortalama_guncel_km' => $ortalama_guncel_km,
                    'toplam_guncel_km' => round($toplam_guncel_km, 2),
                    'arac_sayisi' => $arac_sayisi,
                    'arac_detaylari' => $arac_detaylari
                ];
            }

            return $sonuclar;
        } catch (Exception $e) {
            log_message('error', 'Arac_model::get_arac_sahipler_guncel_km hatası: ' . $e->getMessage());
            return [];
        }
    }

    public function get_tarih_araligi_ortalama_kilometre($baslangic_tarihi, $bitis_tarihi, $secilen_kullanicilar = [])
    {
        try {
            $baslangic = date('Y-m-d 00:00:00', strtotime($baslangic_tarihi));
            $bitis = date('Y-m-d 23:59:59', strtotime($bitis_tarihi));

            $this->db->select('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
            $this->db->from('araclar');
            $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left');
            $this->db->where('araclar.arac_surucu_id >', 0);
            
            if (!empty($secilen_kullanicilar) && is_array($secilen_kullanicilar)) {
                $secilen_kullanicilar = array_map('intval', $secilen_kullanicilar);
                $this->db->where_in('araclar.arac_surucu_id', $secilen_kullanicilar);
            }
            
            $this->db->group_by('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
            $arac_sahipler = $this->db->get()->result();

            if (!$arac_sahipler) {
                return [];
            }

            $sonuclar = [];

            foreach ($arac_sahipler as $sahip) {
                if (empty($sahip->arac_surucu_id)) continue;

                $this->db->select('arac_id, arac_plaka');
                $this->db->from('araclar');
                $this->db->where('arac_surucu_id', $sahip->arac_surucu_id);
                $araclar = $this->db->get()->result();

                if (!$araclar) continue;

                $toplam_km_farki = 0;
                $arac_sayisi = 0;

                foreach ($araclar as $arac) {
                    $this->db->select('arac_km_deger');
                    $this->db->from('arac_kmler');
                    $this->db->where('arac_tanim_id', $arac->arac_id);
                    $this->db->where('arac_km_kayit_tarihi <=', $bitis);
                    $this->db->order_by('arac_km_kayit_tarihi', 'ASC');
                    $this->db->limit(1);
                    $baslangic_km = $this->db->get()->row();

                    if (!$baslangic_km || (isset($baslangic_km->arac_km_kayit_tarihi) && strtotime($baslangic_km->arac_km_kayit_tarihi) < strtotime($baslangic))) {
                        $this->db->select('arac_km_deger');
                        $this->db->from('arac_kmler');
                        $this->db->where('arac_tanim_id', $arac->arac_id);
                        $this->db->where('arac_km_kayit_tarihi <', $baslangic);
                        $this->db->order_by('arac_km_kayit_tarihi', 'DESC');
                        $this->db->limit(1);
                        $baslangic_km = $this->db->get()->row();
                    }

                    $this->db->select('arac_km_deger');
                    $this->db->from('arac_kmler');
                    $this->db->where('arac_tanim_id', $arac->arac_id);
                    $this->db->where('arac_km_kayit_tarihi >=', $baslangic);
                    $this->db->where('arac_km_kayit_tarihi <=', $bitis);
                    $this->db->order_by('arac_km_kayit_tarihi', 'DESC');
                    $this->db->limit(1);
                    $bitis_km = $this->db->get()->row();

                    if ($baslangic_km && $bitis_km && isset($baslangic_km->arac_km_deger) && isset($bitis_km->arac_km_deger)) {
                        $km_farki = floatval($bitis_km->arac_km_deger) - floatval($baslangic_km->arac_km_deger);
                        if ($km_farki > 0) {
                            $toplam_km_farki += $km_farki;
                            $arac_sayisi++;
                        }
                    }
                }

                $ortalama_km = $arac_sayisi > 0 ? round($toplam_km_farki / $arac_sayisi, 2) : 0;

                $sonuclar[] = [
                    'kullanici_id' => intval($sahip->arac_surucu_id),
                    'kullanici_ad_soyad' => $sahip->kullanici_ad_soyad ? $sahip->kullanici_ad_soyad : 'Bilinmeyen',
                    'ortalama_km' => $ortalama_km,
                    'arac_sayisi' => $arac_sayisi,
                    'toplam_km_farki' => round($toplam_km_farki, 2)
                ];
            }

            return $sonuclar;
        } catch (Exception $e) {
            log_message('error', 'Arac_model::get_tarih_araligi_ortalama_kilometre hatası: ' . $e->getMessage());
            return [];
        }
    }






}