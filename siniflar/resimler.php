<?php

class resim_cek
{
    public $resim_sorgu;
    public function __construct($urun_id)
    {
        require_once("config/baglanti.php");
        $baglanti = new baglanti;
        $db = $baglanti->eticaret();
        $sorgu = $db->prepare("SELECT * FROM urun_resimler WHERE urun_id = ?");
        $sorgu->execute(array($urun_id));
        $sorgu = $sorgu->fetchAll();
        $this->resim_sorgu = $sorgu;
    }

    public function resimler_array()
    {
        return $this->resim_sorgu;
    }
}

class resim_ekle
{
    public $database;
    public $urun_id, $resim_url, $resim_alt = "";
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }
    public function set_urunID($veri)
    {
        $this->urun_id = filtre($veri);
    }
    public function set_resimUrl($veri)
    {
        $this->resim_url = filtre($veri);
    }
    public function set_resimAlt($veri)
    {
        $this->resim_alt = filtre($veri);
    }
    public function verileri_ekle()
    {
        $urunID = $this->urun_id;
        $resimURL = $this->resim_url;
        $resimALT = $this->resim_alt;
        if ($urunID != null && $resimURL != null) {
            $db = $this->database;
            $resim_ekle = $db->prepare("INSERT INTO urun_resimler (urun_id, resim_yolu, resim_alt) VALUES (?,?,?)");
            $sonuc = $resim_ekle->execute(array($urunID, $resimURL, $resimALT));
            if ($sonuc) {
                return "basarili";
            } else {
                return "Bir Hata Oluştu!";
            }
        } else {
            return "Lütfen gerekli yerleri doldurunuz.";
        }
    }
}
