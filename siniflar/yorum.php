<?php

class yorum_cek
{
    public $yorum_sorgu, $yorum_sayisi;
    public function __construct($urun_id)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $urun_id = filtre($urun_id);
        if (is_numeric($urun_id)) {
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $sorgu = $db->prepare("SELECT * FROM yorumlar WHERE id = ? OR urun_stok_kodu = ?");
            $sorgu->execute(array($urun_id, $urun_id));
            $yorum_sorgu = $sorgu->fetchAll();
            $this->yorum_sayisi = $sorgu->rowCount();
            $i = 0;
            foreach ($yorum_sorgu as $yorum) {
                $isim_durum = $yorum["isim_durum"];
                if ($isim_durum == 1) {
                    $kullanici_id = $yorum["kullanici_id"];
                    $kullanici_sorgu = $db->query("SELECT isim,soyisim FROM hesaplar WHERE id = " . $kullanici_id)->fetch(PDO::FETCH_ASSOC);
                    $yorum_sorgu[$i]["ad_soyad"] = $kullanici_sorgu["isim"] . " " . $kullanici_sorgu["soyisim"];
                } else {
                    $yorum_sorgu[$i]["ad_soyad"] = "E-Ticaret Kullanıcısı";
                }
                $i++;
            }
            $db = null;
            $this->yorum_sorgu = $yorum_sorgu;
        } else {
            return false;
        }
    }

    public function tum_veriler()
    {
        $sorgu = $this->yorum_sorgu;
        return $sorgu;
    }
    public function yorumSayisi()
    {
        return $this->yorum_sayisi;
    }
    public function kullaniciAdSoyad($index)
    {
        $ad_soyad = $this->yorum_sorgu[$index]["ad_soyad"];
        return $ad_soyad;
    }
    public function puan($index)
    {
        $puan = $this->yorum_sorgu[$index]["puan"];
        return $puan;
    }
    public function yorumBaslik($index)
    {
        $yorum_baslik = $this->yorum_sorgu[$index]["yorum_baslik"];
        return $yorum_baslik;
    }
    public function yorumIcerik($index)
    {
        $yorum_icerik = $this->yorum_sorgu[$index]["yorum_icerik"];
        return $yorum_icerik;
    }
    public function yorumTarih($index)
    {
        $yorum_tarih = $this->yorum_sorgu[$index]["yorum_tarih"];
        return $yorum_tarih;
    }
}

class yorum_ekle
{
    public $database;
    public $urun_id, $puan, $isim_durum, $yorum_baslik, $yorum_icerik;
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
    public function set_puan($veri)
    {
        $this->puan = filtre($veri);
    }
    public function set_isimDurum($veri)
    {
        $veri = filtre($veri);
        if ($veri == 0 || $veri == 1) {
            $this->isim_durum = $veri;
        } else {
            $this->isim_durum = 0;
        }
    }
    public function set_yorumBaslik($veri)
    {
        $this->yorum_baslik = filtre($veri);
    }
    public function set_yorumIcerik($veri)
    {
        $this->yorum_icerik = filtre($veri);
    }

    public function verileri_ekle()
    {
        $urunID = $this->urun_id;
        $puan = $this->puan;
        $isimDurum = $this->isim_durum;
        $yorumBaslik = $this->yorum_baslik;
        $yorumIcerik = $this->yorum_icerik;
        if ($urunID != NULL && $puan != NULL && $isimDurum != NULL && $yorumBaslik != NULL && $yorumIcerik) {
            if (is_numeric($urunID) && is_numeric($puan)) {
                if ($puan > 0 && $puan < 6) {
                    $db = $this->database;
                    $kullanici_id = $_SESSION["kullanici_id"];
                    date_default_timezone_set('Europe/Istanbul');
                    $yorum_tarihi = date("d.m.Y H.i");
                    $yorum_ekle = $db->prepare("INSERT INTO yorumlar (kullanici_id, urun_id, puan, isim_durum, yorum_baslik, yorum_icerik, yorum_tarih) VALUES (?,?,?,?,?,?,?)");
                    $sonuc = $yorum_ekle->execute(array($kullanici_id, $urunID, $puan, $isimDurum, $yorumBaslik, $yorumIcerik, $yorum_tarihi));
                    if ($sonuc) {
                        $puan = "puan_" . $puan;
                        $sorgu = $db->prepare("UPDATE urunler SET `" . $puan . "` = `" . $puan . "` + 1 WHERE id=" . $urunID);
                        $sonuc = $sorgu->execute();
                        $db = null;
                        if ($sonuc) {
                            return "basarili";
                        } else {
                            return "Bir hata oluştu.";
                        }
                    } else {
                        $db = null;
                        return "Bir hata oluştu.";
                    }
                } else {
                    return "Puan aralığı yanlış girildi.";
                }
            } else {
                return "Sayı istenen yerlere yazı girildi...";
            }
        } else {
            return "Tüm alanları doldurunuz.";
        }
    }
}
