<?php

class varyant
{
    public $varyant_sorgu;
    public function __construct()
    {
        require_once("config/baglanti.php");
        $baglanti = new baglanti;
        $db = $baglanti->eticaret();
        $sorgu = $db->prepare("SELECT * FROM varyasyonlar");
        $sorgu->execute();
        $sorgu = $sorgu->fetchAll();
        $db = null;
        $this->varyant_sorgu = $sorgu;
    }

    public function tum_veriler()
    {
        return $this->varyant_sorgu;
    }
}


class varyant_ekle
{
    public $database;
    public $varyantAd;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }
    public function set_varyantAd($veri)
    {
        $this->varyantAd = filtre($veri);
    }

    public function verileri_ekle()
    {
        $varyantAd = $this->varyantAd;
        if ($varyantAd != NULL) {
            $db = $this->database;
            $varyant_sorgu = $db->prepare("SELECT * FROM varyasyonlar WHERE varyant_ad = ?");
            $varyant_sorgu->execute(array($varyantAd));
            $varyant_sorgu_sayisi = $varyant_sorgu->rowCount();
            if ($varyant_sorgu_sayisi > 0) {
                return "Bu varyant daha önceden eklenmiş.";
            } else {
                $varyant_ekle = $db->prepare("INSERT INTO varyasyonlar(varyant_ad) VALUES (?)");
                $sonuc = $varyant_ekle->execute(array($varyantAd));
                if ($sonuc) {
                    return "basarili";
                } else {
                    return "Bir Hata Oluştu!";
                }
            }
        } else {
            return "Tüm alanları doldurunuz.";
        }
    }
}
