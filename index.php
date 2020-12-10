<?php
session_start();
if (!isset($_SESSION["sepettekiler"])) {
    $_SESSION["sepettekiler"] = array();
}
$_SESSION["kullanici_id"] = 1;
$_SESSION["oturum"] = true;

$_SESSION["sepettekiler"][1]["urun_id"] = 1;
$_SESSION["sepettekiler"][1]["urun_adet"] = 2;
$_SESSION["sepettekiler"][1]["sepet_siparis_notu"] = "deneme not session";

require_once("siniflar/resimler.php");
$resim_ekle = new resim_ekle;

$resim_ekle->set_urunID(1);
$resim_ekle->set_resimUrl("resimler/deneme123.png");
$resim_ekle->set_resimAlt("deneme123 resmi");

echo $resim_ekle->verileri_ekle();

// echo "<pre>";
// print_r($varyant->resimler_array());
// echo "</pre>";

// echo $language->dil_ismi();
// print_r($_SESSION["sepettekiler"]);



















// require_once("siniflar/kullanici.php");
// $kullanici_ekle = new kullanici_ekle;

// $kullanici_ekle->set_kadi("deneme2");
// $kullanici_ekle->set_sifre("123");
// $kullanici_ekle->set_sifre_tekrar("123");
// $kullanici_ekle->set_mail("deneme@turkhackteam.org");
// $kullanici_ekle->set_ad("Ahmet");
// $kullanici_ekle->set_soyad("Ahmetoğlu");
// $sonuc = $kullanici_ekle->verileri_ekle();
// if ($sonuc != false) {
//     echo $sonuc;
// }


// require_once("siniflar/language.php");
// $dil_ekle = new set_language;
// $dil_ekle->set_dilKodu("br");
// $dil_ekle->set_dilAdi("Brazil");
// echo $dil_ekle->verileri_ekle();

// require_once("siniflar/siparis.php");
// $siparis_ekle = new siparis_ekle;
// $siparis_ekle->set_musteriID(1);
// $siparis_ekle->set_toplamTutar(50);
// $siparis_ekle->set_kargoUcreti(9);
// $siparis_ekle->set_adres("deneme adres");
// $siparis_ekle->set_token("21564-53165-53156-51586-5154");
// echo $siparis_ekle->verileri_ekle();

// require_once("siniflar/siparis_urun.php");
// $siparis_urun_ekle = new siparis_urun_ekle;
// $siparis_urun_ekle->set_siparisID(1);
// $siparis_urun_ekle->set_urunStokKodu("APP_001");
// $siparis_urun_ekle->set_adet(5);
// $siparis_urun_ekle->set_tutar(50000);
// $siparis_urun_ekle->set_siparisNotu("Gri Renk");
// $siparis_urun_ekle->set_musteriID(1);
// echo $siparis_urun_ekle->verileri_ekle();

// require_once("siniflar/sepet.php");
// $sepete_ekle = new sepete_ekle;

// $sepete_ekle->urun_id(3);
// $sepete_ekle->urun_adet(10);
// $sepete_ekle->siparis_notu("deneme");

// $sepete_ekle->sepete_ekle();

// require_once("siniflar/yorum.php");
// $yorum = new yorum_cek(1);

// echo "<pre>";
// print_r($yorum->tum_veriler());
// echo "</pre>";

// require_once("siniflar/yorum.php");
// $yorum = new yorum_ekle(1);
// $yorum->set_urunID(1);
// $yorum->set_puan(5);
// $yorum->set_isimDurum(1);
// $yorum->set_yorumBaslik("Güzel Bir Cihaz");
// $yorum->set_yorumIcerik("1 aydır kullanıyorum ısınma sorunu falan olmadı.");
// echo $yorum->verileri_ekle();

// echo "<pre>";
// print_r($kullanici_verileri);
// echo "</pre>";