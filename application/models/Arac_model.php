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
     * @return array Aylık ortalama kilometre verileri
     */
    public function get_aylik_ortalama_kilometre()
    {
        // Tüm araç sahiplerini al (arac_surucu_id)
        $arac_sahipler = $this->db
            ->select('DISTINCT arac_surucu_id, kullanicilar.kullanici_ad_soyad')
            ->from('araclar')
            ->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left')
            ->where('arac_surucu_id IS NOT NULL')
            ->where('arac_surucu_id !=', 0)
            ->get()
            ->result();

        $sonuclar = [];
        $aylar = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 
                  'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];

        // Son 12 ay için hesaplama yap
        for ($ay_no = 1; $ay_no <= 12; $ay_no++) {
            $yil = date('Y');
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
                $araclar = $this->db
                    ->select('arac_id, arac_plaka')
                    ->from('araclar')
                    ->where('arac_surucu_id', $sahip->arac_surucu_id)
                    ->get()
                    ->result();

                $toplam_km_farki = 0;
                $arac_sayisi = 0;

                foreach ($araclar as $arac) {
                    // Ay başındaki ilk km kaydı
                    $ay_basi_km = $this->db
                        ->select('arac_km_deger')
                        ->from('arac_kmler')
                        ->where('arac_tanim_id', $arac->arac_id)
                        ->where('arac_km_kayit_tarihi >=', $ay_baslangic)
                        ->where('arac_km_kayit_tarihi <=', $ay_bitis)
                        ->order_by('arac_km_kayit_tarihi', 'ASC')
                        ->limit(1)
                        ->get()
                        ->row();

                    // Ay sonundaki son km kaydı
                    $ay_sonu_km = $this->db
                        ->select('arac_km_deger')
                        ->from('arac_kmler')
                        ->where('arac_tanim_id', $arac->arac_id)
                        ->where('arac_km_kayit_tarihi >=', $ay_baslangic)
                        ->where('arac_km_kayit_tarihi <=', $ay_bitis)
                        ->order_by('arac_km_kayit_tarihi', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row();

                    if ($ay_basi_km && $ay_sonu_km) {
                        $km_farki = floatval($ay_sonu_km->arac_km_deger) - floatval($ay_basi_km->arac_km_deger);
                        if ($km_farki > 0) {
                            $toplam_km_farki += $km_farki;
                            $arac_sayisi++;
                        }
                    }
                }

                $ortalama_km = $arac_sayisi > 0 ? round($toplam_km_farki / $arac_sayisi, 2) : 0;

                $ay_verileri['arac_sahipler'][] = [
                    'kullanici_id' => $sahip->arac_surucu_id,
                    'kullanici_ad_soyad' => $sahip->kullanici_ad_soyad,
                    'ortalama_km' => $ortalama_km,
                    'arac_sayisi' => $arac_sayisi,
                    'toplam_km_farki' => round($toplam_km_farki, 2)
                ];
            }

            $sonuclar[] = $ay_verileri;
        }

        return $sonuclar;
    }







}