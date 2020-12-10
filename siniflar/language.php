<?php

class get_language
{
    public $default, $database;
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        require_once("config/baglanti.php");
        $baglanti = new baglanti();
        $db = $baglanti->eticaret();
        $this->database = $db;
        $this->default = "tr";
        if (isset($_SESSION["language"])) {
            $this->default = $_SESSION["language"];
        }
    }
    public function dil_kodu()
    {
        $db = $this->database;
        $dil_sorgu = $db->prepare("SELECT dil_kodu FROM diller WHERE dil_kodu = ? AND aktif = 1");
        $dil_sorgu->execute(array($this->default));
        $dil_sorgu = $dil_sorgu->fetch(PDO::FETCH_ASSOC);
        return $dil_sorgu["dil_kodu"];
    }
    public function dil_ismi()
    {
        $db = $this->database;
        $dil_sorgu = $db->prepare("SELECT dil_ismi FROM diller WHERE dil_kodu = ? AND aktif = 1");
        $dil_sorgu->execute(array($this->default));
        $dil_sorgu = $dil_sorgu->fetch(PDO::FETCH_ASSOC);
        return $dil_sorgu["dil_ismi"];
    }
}

class set_language
{
    public $database;
    public $dil_kodu, $dil_ismi;
    public function __construct()
    {
        require_once("config/baglanti.php");
        require_once("fonksiyonlar/guvenlik_kontrol.php");
        require_once("fonksiyonlar/format_kontrol.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }

    public function set_dilKodu($veri)
    {
        $this->dil_kodu = filtre($veri);
    }

    public function set_dilAdi($veri)
    {
        $this->dil_ismi = filtre($veri);
    }

    public function verileri_ekle()
    {
        $dil_kodu = $this->dil_kodu;
        $dil_ismi = $this->dil_ismi;
        if ($dil_kodu != null && $dil_ismi != null) {
            if (guvenlik_kontrol($dil_kodu) && guvenlik_kontrol($dil_ismi)) {
                $db = $this->database;
                $dil_sorgu = $db->prepare("SELECT dil_kodu FROM diller WHERE dil_kodu = ?");
                $dil_sorgu->execute(array($dil_kodu));
                $dil_sorgu_sayisi = $dil_sorgu->rowCount();
                if ($dil_sorgu_sayisi > 0) {
                    return "Girdiğiniz dil kodu zaten mevcut. Dil kodu benzersiz olmalıdır.";
                } else {
                    $dil_ekle = $db->prepare("INSERT INTO diller (dil_kodu, dil_ismi) VALUES (?,?)");
                    $dil_sonuc = $dil_ekle->execute(array($dil_kodu, $dil_ismi));
                    if ($dil_sonuc) {
                        $sutun_ekle = $db->prepare("ALTER TABLE kategoriler ADD `" . $dil_kodu . "` varchar(100)");
                        $sutun_sonuc = $sutun_ekle->execute();
                        if ($sutun_ekle) {
                            return "basarili";
                        } else {
                            "Dil eklendi ancak sütun eklenirken bir hata oluştu.";
                        }
                    } else {
                        $db = null;
                        return "Dil eklenirken bir hata oluştu.";
                    }
                }
            } else {
                return "Özel karakter kullanılamaz";
            }
        } else {
            return "Tüm alanları doldurunuz.";
        }
    }
}
