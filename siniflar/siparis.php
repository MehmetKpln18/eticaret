<?php

class siparis
{
    public $siparis_sorgu;
    public function __construct($siparis_no)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $siparis_no = filtre($siparis_no);
        if (is_numeric($siparis_no)) {
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $sorgu = $db->prepare("SELECT * FROM siparisler WHERE siparis_numarasi = ?");
            $sorgu->execute(array($siparis_no));
            $siparis_sorgu = $sorgu->fetch(PDO::FETCH_ASSOC);
            $db = null;
            $this->siparis_sorgu = $siparis_sorgu;
        } else {
            return false;
        }
    }
    public function tum_bilgiler()
    {
        $veri = $this->siparis_sorgu;
        return $veri;
    }
    public function musteriID()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["musteri_id"];
        } else {
            return 0;
        }
    }
    public function toplamTutar()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["toplam_tutar"];
        } else {
            return 0;
        }
    }
    public function kargoUcreti()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["kargo_ucreti"];
        } else {
            return 0;
        }
    }
    public function adres()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["adres"];
        } else {
            return 0;
        }
    }
    public function siparisTarihi()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["siparis_tarihi"];
        } else {
            return 0;
        }
    }
    public function siparisDurum()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["siparis_durum"];
        } else {
            return 0;
        }
    }
    public function siparisIP()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["ip_adresi"];
        } else {
            return 0;
        }
    }
    public function kargoTakipNo()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["kargo_takip_no"];
        } else {
            return 0;
        }
    }
    public function token()
    {
        $veri = $this->siparis_sorgu;
        if ($veri != NULL) {
            return $veri["token"];
        } else {
            return 0;
        }
    }
}

class siparis_ekle
{
    public $database;
    public $musteri_id, $toplam_tutar, $kargo_ucreti, $adres, $token;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }

    public function set_musteriID($veri)
    {
        $this->musteri_id = filtre($veri);
    }
    public function set_toplamTutar($veri)
    {
        $this->toplam_tutar = filtre($veri);
    }
    public function set_kargoUcreti($veri)
    {
        $this->kargo_ucreti = filtre($veri);
    }
    public function set_adres($veri)
    {
        $this->adres = filtre($veri);
    }
    public function set_token($veri)
    {
        $this->token = filtre($veri);
    }

    public function verileri_ekle()
    {
        $musteri_id = $this->musteri_id;
        $toplam_tutar = $this->toplam_tutar;
        $kargo_ucreti = $this->kargo_ucreti;
        $adres = $this->adres;
        $token = $this->token;
        if ($musteri_id != null && $toplam_tutar != null && $kargo_ucreti != null && $adres != null && $token != null) {
            $db = $this->database;
            $siparis_sorgu = $db->prepare("SELECT token FROM siparisler WHERE token = ?");
            $siparis_sorgu->execute(array($token));
            $siparis_sorgu_sayisi = $siparis_sorgu->rowCount();
            if ($siparis_sorgu_sayisi > 0) {
                return "Siparişiniz zaten alındı.";
            } else {
                $ip_adresi = $_SERVER["REMOTE_ADDR"];
                date_default_timezone_set('Europe/Istanbul');
                $siparis_tarihi = date("d.m.Y H.i");
                $siparis_ekle = $db->prepare("INSERT INTO siparisler (musteri_id, toplam_tutar, kargo_ucreti, adres, siparis_tarihi, siparis_durum, ip_adresi, kargo_takip_no, token) VALUES (?,?,?,?,?,?,?,?,?)");
                $sonuc = $siparis_ekle->execute(array($musteri_id, $toplam_tutar, $kargo_ucreti, $adres, $siparis_tarihi, 0, $ip_adresi, 0,$token));
                $db = null;
                if ($sonuc) {
                    return "basarili";
                } else {
                    return "Bir hata oluştu.";
                }
            }
        }
    }
}
