<?php
function get_musteriler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("m.*, s.*");
    $CI->db->from("ugajans_musteriler m");
    $CI->db->join("ugajans_isletmeler s", "s.isletme_musteri_no = m.musteri_id", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_talepler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talepler t");
    $CI->db->join("ugajans_talep_kaynaklar tk", "tk.ugajans_talep_kaynak_id = t.talep_kaynak_no", "left");
    $CI->db->join("ugajans_talep_kategoriler tka", "tka.talep_kategori_id  = t.talep_kategori_no", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_talep_kaynaklar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talep_kaynaklar");
 
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_talep_kategoriler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talep_kategoriler");
 
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_onemli_gun_tanimlari($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_onemli_gun_tanimlari t");
    $CI->db->join("ugajans_musteriler m", "m.musteri_id = t.onemli_gun_tanim_musteri_no", "left");
    $CI->db->join("ugajans_onemli_gunler g", "g.onemli_gun_id = t.onemli_gun_tanim_gun_no", "left");
    $CI->db->order_by("onemli_gun_tarih");
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}


function get_onemli_gunler_right($where = null)
{
    $CI = &get_instance();
    $CI->db->select("a.*");
    $CI->db->from("ugajans_onemli_gunler a");
    $CI->db->join("ugajans_onemli_gun_tanimlari g", "g.onemli_gun_tanim_gun_no = a.onemli_gun_id", "left");
    $CI->db->where("g.onemli_gun_tanim_gun_no IS NULL");  
    if ($where != null) {
        $CI->db->where($where);
    }
    return $CI->db->get()->result();
}

function get_onemli_gunler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_onemli_gunler");

     
    if ($where != null) {
        $CI->db->where($where);
    }
    return $CI->db->get()->result();
}

function get_sosyal_medya_kategoriler()
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_sosyal_medya_kategoriler");

     

    return $CI->db->get()->result();
}

function get_sosyal_medyalar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_sosyal_medya_hesaplar smh");
    $CI->db->join("ugajans_sosyal_medya_kategoriler smk", "smh.sosyal_medya_kategori_no = smk.sosyal_medya_kategori_id", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_isletmeler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_isletmeler");
   
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_musteri_hizmetleri($where = null)
{
    $CI = &get_instance();
    $CI->db->select("mh.*, h.*");
    $CI->db->from("ugajans_musteri_hizmetleri mh");
    $CI->db->join("ugajans_hizmetler h", "h.ugajans_hizmet_id = mh.musteri_hizmet_no", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_gorusme_kayitlari($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_gorusmeler");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_musteri_dokumanlari($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_musteri_dokumanlari");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_hizmetler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_hizmetler");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_kullanicilar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_kullanicilar");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_yapilacak_isler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_yapilacak_isler");
    
    $CI->db->order_by("yapilacak_isler_durum","asc");
    $CI->db->order_by("yapilacak_isler_tarih","asc");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}

function get_musteri_kullanici_atamalar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_musteri_kullanici_tanimlari kt");
    $CI->db->join("ugajans_musteriler m", "m.musteri_id = kt.musteri_kullanici_tanim_musteri_no", "left");
    $CI->db->join("ugajans_kullanicilar k", "k.ugajans_kullanici_id = kt.musteri_kullanici_tanim_kullanici_no", "left");
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}

?>