<?php

class siparis_urun
{
    public $siparis_urun_sorgu;
    public function __construct($siparis_no)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $siparis_no = filtre($siparis_no);
        if (is_numeric($siparis_no)) {
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $sorgu = $db->prepare("SELECT * FROM siparis_urunler WHERE id = ?");
            $sorgu->execute(array($siparis_no));
            $siparis_urun_sorgu = $sorgu->fetch(PDO::FETCH_ASSOC);
            $db = null;
            $this->siparis_urun_sorgu = $siparis_urun_sorgu;
        } else {
            return false;
        }
    }
    public function tum_bilgiler()
    {
        $veri = $this->siparis_urun_sorgu;
        return $veri;
    }
    public function urunStokKodu()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["urun_stok_kodu"];
        } else {
            return 0;
        }
    }
    public function adet()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["urun_adedi"];
        } else {
            return 0;
        }
    }
    public function ucret()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["urun_tutari"];
        } else {
            return 0;
        }
    }
    public function siparisNotu()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["siparis_notu"];
        } else {
            return 0;
        }
    }
    public function musteriID()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["siparis_eden_id"];
        } else {
            return 0;
        }
    }
    public function siparisTarihi()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["siparis_tarihi"];
        } else {
            return 0;
        }
    }
    public function siparisUrunDurum()
    {
        $veri = $this->siparis_urun_sorgu;
        if ($veri != NULL) {
            return $veri["siparis_urun_durum"];
        } else {
            return 0;
        }
    }
}

class siparis_urun_ekle
{
    public $database;
    public $siparisID, $urunStokKodu, $adet, $urun_tutar, $siparisNotu = "", $musteriID;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }

    public function set_siparisID($veri)
    {
        $this->siparisID = filtre($veri);
    }
    public function set_urunStokKodu($veri)
    {
        $this->urunStokKodu = filtre($veri);
    }
    public function set_adet($veri)
    {
        $this->adet = filtre($veri);
    }
    public function set_tutar($veri)
    {
        $this->urun_tutar = filtre($veri);
    }
    public function set_siparisNotu($veri)
    {
        $this->siparisNotu = filtre($veri);
    }
    public function set_musteriID($veri)
    {
        $this->musteriID = filtre($veri);
    }

    public function verileri_ekle()
    {
        $siparisID = $this->siparisID;
        $urunStokKodu = $this->urunStokKodu;
        $adet = $this->adet;
        $urun_tutar = $this->urun_tutar;
        $siparisNotu = $this->siparisNotu;
        $musteriID = $this->musteriID;
        if ($siparisID != null && $urunStokKodu != null && $adet != null && $musteriID != null) {
            $db = $this->database;
            date_default_timezone_set('Europe/Istanbul');
            $siparis_tarihi = date("d.m.Y H.i");
            $siparis_ekle = $db->prepare("INSERT INTO siparis_urunler (siparis_id,urun_stok_kodu,urun_adedi,urun_tutari,siparis_notu,siparis_eden_id,siparis_tarihi,siparis_urun_durum) VALUES (?,?,?,?,?,?,?,?)");
            $sonuc = $siparis_ekle->execute(array($siparisID, $urunStokKodu, $adet, $urun_tutar, $siparisNotu, $musteriID, $siparis_tarihi, 0));
            $db = null;
            if ($sonuc) {
                return "basarili";
            } else {
                return "Bir hata oluştu.";
            }
        }
    }
}
