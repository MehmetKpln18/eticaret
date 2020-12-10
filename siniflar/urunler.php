<?php

class tek_urun_cek
{

    public $urun_sorgu, $urun_var_mi;
    public function __construct($urun)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        $urun = filtre($urun);
        if (urun_guvenlik_kontrol($urun)) {
            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $urun_sorgu = $db->prepare("SELECT * FROM urunler WHERE id = ? OR urun_stok_kodu = ? AND yayin_durum = 1");
            $urun_sorgu->execute(array($urun, $urun));
            $sorgu_sayisi = $urun_sorgu->rowCount();
            if ($sorgu_sayisi > 0) {
                $urun_sorgu = $urun_sorgu->fetch(PDO::FETCH_ASSOC);
                $db = null;
                $this->urun_sorgu = $urun_sorgu;
                $this->urun_var_mi = true;
            } else {
                $this->urun_sorgu = null;
                $this->urun_var_mi = false;
            }
        } else {
            return null;
        }
    }

    public function tum_veriler(){
        return $this->urun_sorgu;
    }

    public function get_id()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["id"];
        } else {
            return 0;
        }
    }

    public function get_ad()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_adi"];
        } else {
            return "HATA!";
        }
    }

    public function get_aciklama()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_aciklama"];
        } else {
            return "HATA!";
        }
    }

    public function get_aciklamaDetay()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_aciklama_detay"];
        } else {
            return "HATA!";
        }
    }

    public function get_ozellikler()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_ozellikler"];
        } else {
            return "HATA!";
        }
    }

    public function get_etiket()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_etiket"];
        } else {
            return "HATA!";
        }
    }

    public function get_indirimDurum()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["indirim_durum"];
        } else {
            return 0;
        }
    }

    public function get_indirimDegeri()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["indirim_degeri"];
        } else {
            return 0;
        }
    }

    public function get_fiyat()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_fiyat"];
        } else {
            return 0;
        }
    }

    public function get_kategoriID()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_kategori_id"];
        } else {
            return 0;
        }
    }

    public function get_resim()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_resim"];
        } else {
            return "assets/img/urun_hata.png";
        }
    }

    public function get_stokKodu()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_stok_kodu"];
        } else {
            return "HATA!";
        }
    }

    public function get_stokAdet()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["urun_stok"];
        } else {
            return 0;
        }
    }

    public function get_eklenmeTarihi()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["eklenme_tarihi"];
        } else {
            return "0.0.0 0.0";
        }
    }

    public function get_yayinDurumu()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["yayin_durum"];
        } else {
            return 0;
        }
    }

    public function get_gosterim()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["gosterim_sayisi"];
        } else {
            return 0;
        }
    }

    public function get_puan()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            $puan_toplam = ($veri["puan1"] * 1) + ($veri["puan2"] * 2) + ($veri["puan3"] * 3) + ($veri["puan4"] * 4) + ($veri["puan5"] * 5) / ($veri["puan1"] + $veri["puan2"] + $veri["puan3"] + $veri["puan4"] + $veri["puan5"]);
            $puan = floor($puan_toplam * 2);
            $puan = $puan / 2;
            return $puan;
        } else {
            return 0;
        }
    }

    public function get_toplamSatis()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["toplam_satis"];
        } else {
            return 0;
        }
    }

    public function get_ustUrunID()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["ust_urun_id"];
        } else {
            return 0;
        }
    }

    public function get_varyantGrup()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["varyant_grup"];
        } else {
            return "HATA!";
        }
    }

    public function get_varyantUrunAd()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["varyant_urun_ad"];
        } else {
            return "HATA!";
        }
    }

    public function get_iadeDurum()
    {
        $veri = $this->urun_sorgu;
        if ($veri != null) {
            return $veri["iade_durum"];
        } else {
            return 0;
        }
    }

    public function urun_kontrol()
    {
        $urun_var_mi = $this->urun_var_mi;
        if ($urun_var_mi) {
            return true;
        } else {
            return false;
        }
    }
}

class urunler
{
    public $urunler_sorgu;
    public function __construct()
    {
        $baglanti = new baglanti;
        $db = $baglanti->eticaret();
        $urun_sorgu = $db->prepare("SELECT * FROM urunler");
        $urun_sorgu->execute();
        $urun_sorgu_sonuc_sayisi = $urun_sorgu->rowCount();
        $urun_sorgu = $urun_sorgu->fetchAll();
        $db = null;
        if ($urun_sorgu_sonuc_sayisi > 0) {
            $this->urunler_sorgu = $urun_sorgu;
        } else {
            $this->urunler_sorgu = null;
        }
    }
    public function tum_veriler()
    {
        $sorgu = $this->urunler_sorgu;
        return $sorgu;
    }
}

class kategori_urun_sirala
{
    public $urun_sorgu;
    public function __construct($siralama_tipi, $kategori_seflink, $limit_ilk, $limit_son)
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        if (guvenlik_kontrol($siralama_tipi) && urun_guvenlik_kontrol($kategori_seflink) && guvenlik_kontrol($limit_ilk) && guvenlik_kontrol($limit_son)) {

            $baglanti = new baglanti;
            $db = $baglanti->eticaret();
            $kategori_id_sorgu = $db->prepare("SELECT id FROM kategoriler where kategori_seflink = ?");
            $kategori_id_sorgu->execute(array($kategori_seflink));
            $kategori_id_sorgu_rowCount = $kategori_id_sorgu->rowCount();

            $kategori_id_sorgu = $kategori_id_sorgu->fetch(PDO::FETCH_ASSOC);
            $kategori_id = $kategori_id_sorgu["id"];

            $alt_kategori_sorgu = $db->prepare("SELECT * FROM kategoriler WHERE ust_kategori_id = ?");
            $alt_kategori_sorgu->execute(array($kategori_id));
            if ($alt_kategori_sorgu->rowCount() < 1) {
                $ids = array($kategori_id);
            } else {
                $ids = array($kategori_id);
                foreach ($alt_kategori_sorgu as $alt_kategori_sorgu_item) {
                    array_push($ids, $alt_kategori_sorgu_item["id"]);
                }
            }
            if ($kategori_id_sorgu_rowCount > 0) {
                if ($siralama_tipi == "populer") {
                    $kategori_urun_sorgu = $db->query("SELECT * FROM urunler WHERE urun_kategori_id IN (" . implode(',', $ids) . ") AND ust_urun_id = '' AND yayin_durum = 1 order by toplam_satis ASC LIMIT " . $limit_ilk . "," . $limit_son . " ")->fetchAll();
                } elseif ($siralama_tipi == "fiyatartan") {
                    $kategori_urun_sorgu = $db->query("SELECT *, IF(`indirim_durum` = 0, `urun_fiyat`, `urun_fiyat`-((`urun_fiyat`*`indirim_degeri`)/100)) AS son_fiyat FROM `urunler` WHERE urun_kategori_id IN (" . implode(',', $ids) . ") AND ust_urun_id = '' AND yayin_durum = 1 ORDER BY son_fiyat ASC LIMIT " . $limit_ilk . "," . $$limit_son . " ")->fetchAll();
                } elseif ($siralama_tipi == "fiyatazalan") {
                    $kategori_urun_sorgu = $db->query("SELECT *, IF(`indirim_durum` = 0, `urun_fiyat`, `urun_fiyat`-((`urun_fiyat`*`indirim_degeri`)/100)) AS son_fiyat FROM `urunler` WHERE urun_kategori_id IN (" . implode(',', $ids) . ") AND ust_urun_id = '' AND yayin_durum = 1 ORDER BY son_fiyat DESC LIMIT " . $limit_ilk . "," . $$limit_son . " ")->fetchAll();
                } elseif ($siralama_tipi == "puan") {
                    $kategorisiralama_tipi_urun_sorgu = $db->query("SELECT *, (`puan_1`*1 + `puan_2`*2 + `puan_3`*3 + `puan_4`*4 + `puan_5`*5)/(`puan_1`+`puan_2`+`puan_3`+`puan_4`+`puan_5`) AS puan_sonuc FROM `urunler` WHERE urun_kategori_id IN (" . implode(',', $ids) . ") AND ust_urun_id = '' AND yayin_durum = 1 ORDER BY puan_sonuc DESC LIMIT " . $limit_ilk . "," . $$limit_son . " ")->fetchAll();
                } elseif ($siralama_tipi == "indirim") {
                    $kategori_urun_sorgu = $db->query("SELECT *, IF(`indirim_durum` = 0, 0, `indirim_degeri`) AS indirim_siralama FROM `urunler` WHERE urun_kategori_id IN (" . implode(',', $ids) . ") AND ust_urun_id = '' AND yayin_durum = 1 ORDER BY indirim_siralama DESC LIMIT " . $limit_ilk . "," . $$limit_son . " ")->fetchAll();
                } else {
                    $kategori_urun_sorgu = $db->query("SELECT * FROM urunler WHERE urun_kategori_id IN (" . implode(',', $ids) . ") AND ust_urun_id = '' AND yayin_durum = 1 order by toplam_satis ASC LIMIT " . $limit_ilk . "," . $limit_son . " ")->fetchAll();
                }
                $this->urun_sorgu = $kategori_urun_sorgu;
            } else {
                $this->urun_sorgu = null;
            }
        }else {
            return null;
        }
    }

    public function get_urunArray()
    {
        $sorgu = $this->urun_sorgu;
        if ($sorgu != null) {
            return $sorgu;
        } else {
            return false;
        }
    }
}

class urun_ekle
{
    public $database;
    public $urunAd, $aciklama, $aciklamaDetay, $ozellikler, $etiket, $fiyat, $resim, $stokKodu;
    public $indirimDurum = 0, $indirimDeger = 0, $kategoriID = 1, $stokAdet = 0, $yayinDurum = 1, $ustUrunID = 0, $varyantGrup = "", $varyantAd = "", $iadeDurum = 1;

    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }
    public function set_urunAd($veri)
    {
        $this->urunAd = filtre($veri);
    }
    public function set_aciklama($veri)
    {
        $this->aciklama = filtre($veri);
    }
    public function set_aciklamaDetay($veri)
    {
        $this->aciklamaDetay = filtre($veri);
    }
    public function set_ozellikler($veri)
    {
        $this->ozellikler = filtre($veri);
    }
    public function set_etiket($veri)
    {
        $this->etiket = filtre($veri);
    }
    public function set_indirimDurum($veri)
    {
        $this->indirimDurum = filtre($veri);
    }
    public function set_indirimDeger($veri)
    {
        $this->indirimDeger = filtre($veri);
    }
    public function set_fiyat($veri)
    {
        $this->fiyat = filtre($veri);
    }
    public function set_kategoriID($veri)
    {
        $this->kategoriID = filtre($veri);
    }
    public function set_resim($veri)
    {
        $this->resim = filtre($veri);
    }
    public function set_stokKodu($veri)
    {
        $this->stokKodu = filtre($veri);
    }
    public function set_stokAdet($veri)
    {
        $this->stokAdet = filtre($veri);
    }
    public function set_ustUrunID($veri)
    {
        $this->ustUrunID = filtre($veri);
    }
    public function set_varyantGrup($veri)
    {
        $this->varyantGrup = filtre($veri);
    }
    public function set_varyantAd($veri)
    {
        $this->varyantAd = filtre($veri);
    }
    public function set_iadeDurum($veri)
    {
        $this->iadeDurum = filtre($veri);
    }

    public function verileri_ekle()
    {
        $urunAd = $this->urunAd;
        $aciklama = $this->aciklama;
        $aciklamaDetay = $this->aciklamaDetay;
        $ozellikler = $this->ozellikler;
        $etiket = $this->etiket;
        $indirimDurum = $this->indirimDurum;
        $fiyat = $this->fiyat;
        $resim = $this->resim;
        $stokKodu = $this->stokKodu;
        $indirimDeger = $this->indirimDeger;
        $kategoriID = $this->kategoriID;
        $stokAdet = $this->stokAdet;
        $yayinDurum = $this->yayinDurum;
        $ustUrunID = $this->ustUrunID;
        $varyantGrup = $this->varyantGrup;
        $varyantAd = $this->varyantAd;
        $iadeDurum = $this->iadeDurum;

        if ($urunAd != NULL && $aciklama != NULL && $aciklamaDetay != NULL && $ozellikler != NULL && $etiket != NULL && $fiyat != NULL && $resim != NULL && $kategoriID != NULL) {
            if (is_numeric($indirimDurum) && is_numeric($fiyat) && is_numeric($indirimDeger) && is_numeric($kategoriID) && is_numeric($stokAdet) && is_numeric($yayinDurum) && is_numeric($ustUrunID) && is_numeric($iadeDurum)) {
                $db = $this->database;
                $urun_sorgu = $db->prepare("SELECT urun_stok_kodu FROM urunler WHERE urun_stok_kodu = ?");
                $urun_sorgu->execute(array($stokKodu));
                $urun_sorgu_sayisi = $urun_sorgu->rowCount();
                if ($urun_sorgu_sayisi > 0) {
                    return "Her ürün farklı stok koduna sahip olmalıdır.";
                } else {
                    date_default_timezone_set('Europe/Istanbul');
                    $eklenme_tarihi = date("d.m.Y H.i.s");
                    $urun_ekle = $db->prepare("INSERT INTO urunler (urun_adi,urun_aciklama,urun_aciklama_detay,urun_ozellikler,urun_etiket,indirim_durum,indirim_degeri,urun_fiyat,urun_kategori_id,urun_resim,urun_stok_kodu,urun_stok,eklenme_tarihi,yayin_durum,ust_urun_id,varyant_grup,varyant_urun_ad,iade_durum) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $sonuc = $urun_ekle->execute(array($urunAd, $aciklama, $aciklamaDetay, $ozellikler, $etiket, $indirimDurum, $indirimDeger, $fiyat, $kategoriID, $resim, $stokKodu, $stokAdet, $eklenme_tarihi, $yayinDurum, $ustUrunID, $varyantGrup, $varyantAd, $iadeDurum));
                    $db = null;
                    if ($sonuc) {
                        return "basarili";
                    } else {
                        return "Bir hata oluştu.";
                    }
                }
            } else {
                return "Hata! Sayı girilmesi gereken yerlere yazı girdiniz.";
            }
        } else {
            return "Lütfen gerekli yerleri doldurunuz.";
        }
    }
}
