<?php

class adres_cek
{
    public $adres_sorgu;
    public function __construct($adres_id)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $adres_id = filtre($adres_id);
        if (is_numeric($adres_id)) {
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $sorgu = $db->prepare("SELECT * FROM adresler WHERE id = ?");
            $sorgu->execute(array($adres_id));
            $adres_sorgu = $sorgu->fetch(PDO::FETCH_ASSOC);
            $db = null;
            $this->adres_sorgu = $adres_sorgu;
        } else {
            return false;
        }
    }
    public function tum_bilgiler()
    {
        $veri = $this->adres_sorgu;
        return $veri;
    }
    public function adresBaslik()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["adres_baslik"];
        } else {
            return 0;
        }
    }
    public function musteriID()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_id"];
        } else {
            return 0;
        }
    }
    public function musteriAd()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_ad"];
        } else {
            return 0;
        }
    }
    public function musteriSoyad()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_soyad"];
        } else {
            return 0;
        }
    }
    public function mail()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_mail"];
        } else {
            return 0;
        }
    }
    public function telefon()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["telefon"];
        } else {
            return 0;
        }
    }
    public function adres1()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_adres1"];
        } else {
            return 0;
        }
    }
    public function adres2()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_adres2"];
        } else {
            return 0;
        }
    }
    public function ulke()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_ulke"];
        } else {
            return 0;
        }
    }
    public function il()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_il"];
        } else {
            return 0;
        }
    }
    public function ilce()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_ilce"];
        } else {
            return 0;
        }
    }
    public function postaKodu()
    {
        $veri = $this->adres_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_postakodu"];
        } else {
            return 0;
        }
    }
}

class adres_ekle
{
    public $database;
    public $adresBaslik, $musteriID, $ad, $soyad, $mail, $telefon, $adres1, $adres2, $ulke, $il, $ilce, $postaKodu;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }

    public function set_adresBaslik($veri)
    {
        $this->adresBaslik = filtre($veri);
    }
    public function set_musteriID($veri)
    {
        $this->musteriID = filtre($veri);
    }
    public function set_ad($veri)
    {
        $this->ad = filtre($veri);
    }
    public function set_soyad($veri)
    {
        $this->soyad = filtre($veri);
    }
    public function set_mail($veri)
    {
        $this->mail = filtre($veri);
    }
    public function set_telefon($veri)
    {
        $this->telefon = filtre($veri);
    }
    public function set_adres1($veri)
    {
        $this->adres1 = filtre($veri);
    }
    public function set_adres2($veri)
    {
        $this->adres2 = filtre($veri);
    }
    public function set_ulke($veri)
    {
        $this->ulke = filtre($veri);
    }
    public function set_il($veri)
    {
        $this->il = filtre($veri);
    }
    public function set_ilce($veri)
    {
        $this->ilce = filtre($veri);
    }
    public function set_postaKodu($veri)
    {
        $this->postaKodu = filtre($veri);
    }

    public function verileri_ekle()
    {
        $adresBaslik = $this->adresBaslik;
        $musteriID = $this->musteriID;
        $ad = $this->ad;
        $soyad = $this->soyad;
        $mail = $this->mail;
        $telefon = $this->telefon;
        $adres1 = $this->adres1;
        $adres2 = $this->adres2;
        $ulke = $this->ulke;
        $il = $this->il;
        $ilce = $this->ilce;
        $postaKodu = $this->postaKodu;
        if ($adresBaslik != null && $musteriID != null && $ad != null && $soyad != null && $mail != null && $telefon != null && $adres1 != null && $adres2 != null && $ulke != null && $il != null && $ilce != null && $postaKodu != null) {
            if (mail_kontrol($mail)) {
                $db = $this->database;
                $adres_ekle = $db->prepare("INSERT INTO adresler (adres_baslik,kullanici_id,kullanici_ad,kullanici_soyad,kullanici_mail,telefon,kullanici_adres1,kullanici_adres2,kullanici_ulke,kullanici_il,kullanici_ilce,kullanici_postakodu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                $sonuc = $adres_ekle->execute(array($adresBaslik, $musteriID, $ad, $soyad, $mail, $telefon, $adres1, $adres2, $ulke, $il, $ilce, $postaKodu));
                $db = null;
                if ($sonuc) {
                    return "basarili";
                } else {
                    return "Bir hata oluştu.";
                }
            } else {
                return "Lütfen geçerli bir E-Posta adresi girin.";
            }
        } else {
            return "Tüm alanları doldurunuz.";
        }
    }
}
