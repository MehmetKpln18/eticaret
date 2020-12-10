<?php


class language_settings
{
    public $dil_kodu, $database, $dil_ismi;

    public function __construct()
    {
        require_once("baglanti.php");
        $baglanti = new baglanti;
        $this->database = $baglanti->eticaret();
    }

    public function dil_ekle($dil_kodu, $dil_ismi)
    {
        $db = $this->database;
        $dil_var_mi_sorgu = "SELECT dil_kodu FROM diller WHERE dil_kodu = ?";
        $dil_sayi_sorgu = $db->prepare($dil_var_mi_sorgu);
        $dil_sayi_sorgu->execute(array($dil_kodu));
        $dil_sayi = $dil_sayi_sorgu->rowCount();
        if ($dil_sayi > 0) {
            return false;
        } else {
            $dil_ekle_sorgu = "INSERT INTO diller (dil_kodu, dil_ismi, aktif) VALUES (?,?,?)";
            $dil_ekle = $db->prepare($dil_ekle_sorgu);
            $sonuc = $dil_ekle->execute(array($dil_kodu, $dil_ismi, 1));
            $db = NULL;
            if ($sonuc)
                return true;
            else
                return false;
        }
    }

    public function dil_sil($dil_kodu)
    {
        $db = $this->database;
        $dil_var_mi_sorgu = "SELECT dil_kodu FROM diller WHERE dil_kodu = ?";
        $dil_sayi_sorgu = $db->prepare($dil_var_mi_sorgu);
        $dil_sayi_sorgu->execute(array($dil_kodu));
        $dil_sayi = $dil_sayi_sorgu->rowCount();
        if ($dil_sayi > 0) {
            $dil_ekle_sorgu = "DELETE FROM diller WHERE dil_kodu = ?";
            $dil_ekle = $db->prepare($dil_ekle_sorgu);
            $sonuc = $dil_ekle->execute(array($dil_kodu));
            $db = NULL;
            if ($sonuc)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }
}
