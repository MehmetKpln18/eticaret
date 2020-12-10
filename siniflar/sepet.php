<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class sepet_veri_cek
{
    public $database;
    public $sepet_sorgu, $urunID, $oturum;
    public function __construct($urunID)
    {
        if (isset($_SESSION["oturum"])) {
            $oturum = $_SESSION["oturum"];
        } else {
            $oturum = false;
        }
        $this->oturum = $oturum;
        require_once("config/baglanti.php");
        $baglanti = new baglanti;
        $db = $baglanti->eticaret();
        $this->database = $db;
        if ($oturum) {
            $kullanici_id = $_SESSION["kullanici_id"];
            $sorgu = $db->prepare("SELECT * FROM sepet WHERE urun_id = ? AND kullanici_id = ?");
            $sorgu->execute(array($urunID, $kullanici_id));
            $sepet_sorgu = $sorgu->fetch(PDO::FETCH_ASSOC);
            $db = null;
            $this->sepet_sorgu = $sepet_sorgu;
            $this->urunID = $urunID;
        } else {
            $this->urunID = $urunID;
        }
    }
    public function sepetUrunAdet()
    {
        $oturum = $this->oturum;
        if ($oturum) {
            $sepet_sorgu = $this->sepet_sorgu;
            return $sepet_sorgu["urun_adet"];
        } else {
            $urunID = $this->urunID;
            return $_SESSION["sepettekiler"][$urunID]["urun_adet"];
        }
    }
    public function sepetUrunNot()
    {
        $oturum = $this->oturum;
        if ($oturum) {
            $sepet_sorgu = $this->sepet_sorgu;
            return $sepet_sorgu["sepet_siparis_notu"];
        } else {
            $urunID = $this->urunID;
            return $_SESSION["sepettekiler"][$urunID]["sepet_siparis_notu"];
        }
    }
    public function sepetUrunResim()
    {
        $db = $this->database;
        $urunID = $this->urunID;
        $urun_sorgu = $db->query("SELECT urun_resim FROM urunler WHERE id = " . $urunID)->fetch(PDO::FETCH_ASSOC);
        return $urun_sorgu["urun_resim"];
    }
    public function sepetUrunFiyat()
    {
        $db = $this->database;
        $urunID = $this->urunID;
        $urun_sorgu = $db->query("SELECT IF(`indirim_durum` = 0, `urun_fiyat`, `urun_fiyat`-((`urun_fiyat`*`indirim_degeri`)/100)) AS fiyat FROM urunler WHERE id = " . $urunID)->fetch(PDO::FETCH_ASSOC);
        return $urun_sorgu["fiyat"];
    }
    public function sepetUrunIndirimDurum()
    {
        $db = $this->database;
        $urunID = $this->urunID;
        $urun_sorgu = $db->query("SELECT indirim_durum FROM urunler WHERE id = " . $urunID)->fetch(PDO::FETCH_ASSOC);
        if ($urun_sorgu["indirim_durum"] == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function sepetUrunIndirimDegeri()
    {
        $db = $this->database;
        $urunID = $this->urunID;
        $urun_sorgu = $db->query("SELECT indirim_degeri FROM urunler WHERE id = " . $urunID)->fetch(PDO::FETCH_ASSOC);
        return $urun_sorgu["indirim_degeri"];
    }
}

class sepete_ekle
{
    public $database;
    public $kullanici_id, $urun_id, $urun_adet, $siparis_notu;
    public function __construct()
    {
        if (isset($_SESSION["oturum"])) {
            $oturum = $_SESSION["oturum"];
        } else {
            $oturum = false;
        }
        $this->oturum = $oturum;
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $baglanti = new baglanti;
        $db = $baglanti->eticaret();
        $this->database = $db;
        $db = null;
    }

    public function urun_id($veri)
    {
        $this->urun_id = filtre($veri);
    }
    public function urun_adet($veri)
    {
        $this->urun_adet = filtre($veri);
    }
    public function siparis_notu($veri)
    {
        $this->siparis_notu = filtre($veri);
    }

    public function sepete_ekle()
    {
        $urun_id = $this->urun_id;
        $urun_adet = $this->urun_adet;
        $siparis_notu = $this->siparis_notu;
        $oturum = $this->oturum;
        if ($oturum) {
            $kullanici_id = $_SESSION["kullanici_id"];
            $db = $this->database;
            $sepet_sorgu = $db->prepare("SELECT urun_adet, urun_id, kullanici_id FROM sepet WHERE urun_id = ? AND kullanici_id = ?");
            $sepet_sorgu->execute(array($urun_id, $kullanici_id));
            $sepet_sorgu_sayisi = $sepet_sorgu->rowCount();
            if ($sepet_sorgu_sayisi > 0) {
                return false;
            } else {
                $sorgu = $db->prepare("INSERT INTO sepet (kullanici_id,urun_id,urun_adet,sepet_siparis_notu) VALUES (?,?,?,?)");
                $sorgu->execute(array($kullanici_id, $urun_id, $urun_adet, $siparis_notu));
                $sepete_ekle = $sorgu->fetch(PDO::FETCH_ASSOC);
                $db = null;
                if ($sepete_ekle) {
                    return true;
                }else {
                    return false;
                }
            }
        } else {
            if (!isset($_SESSION["sepettekiler"])) {
                $_SESSION["sepettekiler"] = array();
            }
            $_SESSION["sepettekiler"][$urun_id]["urun_id"] = $urun_id;
            $_SESSION["sepettekiler"][$urun_id]["urun_adet"] = $urun_adet;
            $_SESSION["sepettekiler"][$urun_id]["siparis_notu"] = $siparis_notu;
        }
    }
}
