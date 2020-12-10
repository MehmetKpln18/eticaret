<?php


class get_kategori
{
    public $database, $dil_kodu, $default_language;
    public function __construct()
    {
        require_once("siniflar/language.php");
        $dil = new get_language;
        $this->dil_kodu = $dil->dil_kodu();

        require_once("config/baglanti.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();

        $this->default_language = "tr";
    }
    public function tum_kategoriler()
    {
        $db = $this->database;
        $varsayilan_dil_kodu = $this->default_language;
        $dil_kodu = $this->dil_kodu;
        $sorgu = "SELECT id, ust_kategori_id, kategori_seflink, IF(`$dil_kodu` = '' , `$varsayilan_dil_kodu`, `$dil_kodu`) AS kategori_ad FROM kategoriler WHERE aktif = 1";
        $kategori_sorgu = $db->prepare($sorgu);
        $kategori_sorgu->execute();
        $kategori_sorgu_sonuc_sayisi = $kategori_sorgu->rowCount();
        $kategori_sorgu_sonuc = $kategori_sorgu->fetchAll();
        $db = null;
        if ($kategori_sorgu_sonuc_sayisi > 0)
            return $kategori_sorgu_sonuc;
        else
            return false;
    }
    public function kategori($kategori_id)
    {
        if (is_numeric($kategori_id)) {
            $db = $this->database;
            $varsayilan_dil_kodu = $this->default_language;
            $dil_kodu = $this->dil_kodu;
            $sorgu = "SELECT id, ust_kategori_id, kategori_seflink, IF(`$dil_kodu` = '' , `$varsayilan_dil_kodu`, `$dil_kodu`) AS kategori_ad FROM kategoriler WHERE id = " . $kategori_id . " AND aktif = 1";
            $kategori_sorgu_sonuc_sayisi = $db->query($sorgu)->fetchColumn();
            $kategori_sorgu_sonuc = $db->query($sorgu)->fetch(PDO::FETCH_ASSOC);;
            $db = null;

            if ($kategori_sorgu_sonuc_sayisi > 0)
                return $kategori_sorgu_sonuc;
            else
                return false;
        } else {
            return false;
        }
    }
}

class kategori_ekle
{
    public $database;
    public $ustID = 0, $seflink, $aktif = 1;
    public $diller = array(), $diller_veri, $diller_sayi;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("config/config.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
        $db = $baglanti->information_schema();
        $diller = "";
        $diller_sayi = "";
        $sorguSayisi = $db->query("SELECT count(*) FROM COLUMNS WHERE TABLE_SCHEMA = '" . $dbname . "' AND TABLE_NAME = '" . $table . "'")->fetchColumn();
        $sorgu = $db->query("SELECT COLUMN_NAME FROM COLUMNS WHERE TABLE_SCHEMA = '" . $dbname . "' AND TABLE_NAME = '" . $table . "'")->fetchAll();
        for ($i = 4; $i < $sorguSayisi; $i++) {
            $diller = $diller . "" . $sorgu[$i]["COLUMN_NAME"] . ",";
            $diller_sayi = $diller_sayi . "?,";
        }
        $this->diller = rtrim($diller, ",");
        $this->diller_sayi = rtrim($diller_sayi, ",");
    }
    public function set_ustID($veri)
    {
        $this->ustID = filtre($veri);
    }
    public function set_seflink($veri)
    {
        $this->seflink = filtre($veri);
    }
    public function set_aktif($veri)
    {
        $this->aktif = filtre($veri);
    }
    public function set_diller($veri)
    {
        $this->diller_veri = $veri;
    }

    public function verileri_ekle()
    {
        $ustID = $this->ustID;
        $seflink = $this->seflink;
        $aktif = $this->aktif;
        $diller = $this->diller;
        $diller_sayi = $this->diller_sayi;
        $diller_veri = $this->diller_veri;
        if (is_array($diller_veri)) {
            $dil_guvenlik_kontrol = true;
            foreach ($diller_veri as $dil) {
                if (!guvenlik_kontrol($dil)) {
                    $dil_guvenlik_kontrol = false;
                }
            }
            if ($ustID != null && $seflink != null && $aktif != null) {
                if (guvenlik_kontrol($ustID) && urun_guvenlik_kontrol($seflink) && guvenlik_kontrol($aktif) && $dil_guvenlik_kontrol) {
                    $db = $this->database;
                    $kategori_ekle = $db->prepare("SELECT kategori_seflink FROM kategoriler WHERE kategori_seflink = ?");
                    $kategori_ekle->execute(array($seflink));
                    $kategori_sorgu_sayisi = $kategori_ekle->rowCount();
                    if ($kategori_sorgu_sayisi > 0) {
                        return "Kategorilerin SEFLinkleri benzersiz olmalıdır. Aynı SEFLink'ten 2 tane olamaz.";
                    } else {
                        $eklenecekler = array($ustID, $seflink, $aktif);
                        $eklenecekler = array_merge($eklenecekler, $diller_veri);
                        try {
                            $kategori_ekle = $db->prepare("INSERT INTO kategoriler (ust_kategori_id, kategori_seflink, aktif," . $diller . ") VALUES (?,?,?," . $diller_sayi . ")");
                            $sonuc = $kategori_ekle->execute($eklenecekler);
                            $db = null;
                            if ($sonuc) {
                                return "basarili";
                            } else {
                                return "Bir hata oluştu.";
                            }
                        } catch (\Exception $e) {
                            return "Bir hata oluştu. Lütfen eklenen dil sayısını kontrol edin.";
                        }
                    }
                } else {
                    return "Özel Karakter Kullanmayınız.";
                }
            } else {
                return "Boş bırakmayınız.";
            }
        } else {
            return "Diller verisi bir dizi olmalı!";
        }
    }
}
