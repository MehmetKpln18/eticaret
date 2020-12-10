<?php

class kullanici_verileri
{
    public $kullanici_sorgu;
    public function __construct($k_adi)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $k_adi = filtre($k_adi);
        if (guvenlik_kontrol($k_adi)) {
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $sorgu = $db->prepare("SELECT * FROM hesaplar WHERE id = ? OR kullanici_adi = ?");
            $sorgu->execute(array($k_adi, $k_adi));
            $kullanici_sorgu = $sorgu->fetch(PDO::FETCH_ASSOC);
            $db = null;
            $this->kullanici_sorgu = $kullanici_sorgu;
        } else {
            return false;
        }
    }
    public function tum_bilgiler()
    {
        $veri = $this->kullanici_sorgu;
        return $veri;
    }
    public function kullanici_adi()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_adi"];
        } else {
            return "HATA!";
        }
    }
    public function sifre()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return md5($veri["kullanici_sifre"]);
        } else {
            return null;
        }
    }
    public function mail()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["kullanici_mail"];
        } else {
            return "HATA!";
        }
    }
    public function ad()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["isim"];
        } else {
            return "HATA!";
        }
    }
    public function soyad()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["soyisim"];
        } else {
            return "HATA!";
        }
    }
    public function kayit_tarihi()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["kayit_tarihi"];
        } else {
            return "HATA!";
        }
    }
    public function son_giris_tarihi()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["son_giris_tarihi"];
        } else {
            return "HATA!";
        }
    }
    public function secili_adres_id()
    {
        $veri = $this->kullanici_sorgu;
        if ($veri != NULL) {
            return $veri["secili_adres_id"];
        } else {
            return "HATA";
        }
    }
}


class kullanici_ekle
{
    public $database;
    public $kadi, $sifre, $sifre_tekrar, $mail, $ad, $soyad;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }
    public function set_kadi($kadi)
    {
        $this->kadi = filtre($kadi);
    }
    public function set_sifre($sifre)
    {
        $this->sifre = filtre($sifre);
    }
    public function set_sifre_tekrar($sifre_tekrar)
    {
        $this->sifre_tekrar = filtre($sifre_tekrar);
    }
    public function set_mail($mail)
    {
        $this->mail = filtre($mail);
    }
    public function set_ad($ad)
    {
        $this->ad = filtre($ad);
    }
    public function set_soyad($soyad)
    {
        $this->soyad = filtre($soyad);
    }
    public function verileri_ekle()
    {
        $kadi = $this->kadi;
        $sifre = $this->sifre;
        $sifre_tekrar = $this->sifre_tekrar;
        $mail = $this->mail;
        $ad = $this->ad;
        $soyad = $this->soyad;
        if ($kadi != null && $sifre != null && $mail != null && $ad != null && $soyad != null) {
            if (mail_kontrol($mail)) {
                if (guvenlik_kontrol($kadi) && guvenlik_kontrol($sifre) && mail_guvenlik_kontrol($mail) && guvenlik_kontrol($ad) && guvenlik_kontrol($soyad)) {
                    if ($sifre == $sifre_tekrar) {
                        $db = $this->database;
                        $kullanici_sorgu = $db->prepare("SELECT kullanici_adi FROM hesaplar WHERE kullanici_adi = ?");
                        $kullanici_sorgu->execute(array($kadi));
                        $kullanici_sorgu_sayisi = $kullanici_sorgu->rowCount();
                        if ($kullanici_sorgu_sayisi > 0) {
                            $db = null;
                            return 'Bu Kullanici Adı daha zaten alınmış. Eğer sizseniz giriş yapabilir veya "Şifremi unuttum" adresinden yeni şifre talep edebilirsiniz.';
                        } else {
                            $mail_sorgu = $db->prepare("SELECT kullanici_mail FROM hesaplar WHERE kullanici_mail = ?");
                            $mail_sorgu->execute(array($mail));
                            $mail_sorgu_sonuc = $mail_sorgu->rowCount();
                            if ($mail_sorgu_sonuc > 0) {
                                $db = null;
                                return 'Bu E-Posta Adresi daha önceden kullanıldı. Eğer sizseniz giriş yapabilir veya "Şifremi unuttum" adresinden yeni şifre talep edebilirsiniz.';
                            } else {
                                $sifre = md5($sifre);
                                date_default_timezone_set('Europe/Istanbul');
                                $kayit_tarihi = date("d.m.Y H.i.s");
                                $son_giris_tarihi = date("d.m.Y H.i.s");
                                $secili_adres_id = 0;
                                $kullanici_ekle = $db->prepare("INSERT INTO hesaplar (kullanici_adi, kullanici_sifre, kullanici_mail, isim, soyisim, kayit_tarihi, son_giris_tarihi, secili_adres_id) VALUES (?,?,?,?,?,?,?,?)");
                                $sonuc = $kullanici_ekle->execute(array($kadi, $sifre, $mail, $ad, $soyad, $kayit_tarihi, $son_giris_tarihi, $secili_adres_id));
                                $db = null;
                                if ($sonuc) {
                                    return "basarili";
                                } else {
                                    return "Bir hata oluştu.";
                                }
                            }
                        }
                    } else {
                        return "Şifreler uyuşmuyor.";
                    }
                } else {
                    return "Özel karakter kullanmayınız...";
                }
            } else {
                return "Lütfen geçerli bir E-Posta Adresi giriniz.";
            }
        } else {
            return "Boş alan bırakmayınız.";
        }
    }
}

class kullanici_kontrol
{
    public $sonuc;
    public function __construct($kullanici_adi, $sifre)
    {
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $kullanici_adi = filtre($kullanici_adi);
        $sifre = filtre($sifre);
        if (guvenlik_kontrol($kullanici_adi) && guvenlik_kontrol($sifre)) {
            $sifre = md5($sifre);
            require_once("config/baglanti.php");
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $kullanici_sorgu = $db->prepare("SELECT kullanici_adi, kullanici_sifre FROM hesaplar WHERE kullanici_adi = ? AND kullanici_sifre = ?");
            $kullanici_sorgu->execute(array($kullanici_adi, $sifre));
            $kullanici_sorgu_sayisi = $kullanici_sorgu->rowCount();
            $db = null;
            if ($kullanici_sorgu_sayisi > 0) {
                $this->sonuc = true;
            } else {
                $this->sonuc = false;
            }
        } else {
            $this->sonuc = false;
        }
    }
    public function sonuc()
    {
        return $this->sonuc;
    }
}
