-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Ara 2020, 11:20:31
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eticaret`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresler`
--

CREATE TABLE `adresler` (
  `id` int(11) NOT NULL,
  `adres_baslik` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `kullanici_ad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adres1` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adres2` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ulke` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_il` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ilce` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_postakodu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `adresler`
--

INSERT INTO `adresler` (`id`, `adres_baslik`, `kullanici_id`, `kullanici_ad`, `kullanici_soyad`, `kullanici_mail`, `telefon`, `kullanici_adres1`, `kullanici_adres2`, `kullanici_ulke`, `kullanici_il`, `kullanici_ilce`, `kullanici_postakodu`) VALUES
(1, 'Ev Adresi', 1, 'LosT', 'THT', 'lost@turkhackteam.org', '+90 561 655 2258', 'deneme adres1', 'deneme adres2', 'Turkiye', 'Ankara', 'Çankaya', 6000),
(2, 'Ev Adresi', 1, 'LosT', 'THT', 'lost@turkhackteam.org', '+90 561 655 2258', 'deneme adres1', 'deneme adres2', 'Turkiye', 'Ankara', 'Çankaya', 6000);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `diller`
--

CREATE TABLE `diller` (
  `dil_kodu` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `dil_ismi` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(1) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `diller`
--

INSERT INTO `diller` (`dil_kodu`, `dil_ismi`, `aktif`) VALUES
('br', 'Brazil', 0),
('en', 'English', 1),
('fr', 'French', 1),
('tr', 'Türkçe', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hesaplar`
--

CREATE TABLE `hesaplar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_sifre` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isim` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `soyisim` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `kayit_tarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `son_giris_tarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `secili_adres_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hesaplar`
--

INSERT INTO `hesaplar` (`id`, `kullanici_adi`, `kullanici_sifre`, `kullanici_mail`, `isim`, `soyisim`, `kayit_tarihi`, `son_giris_tarihi`, `secili_adres_id`) VALUES
(1, 'LosT', '202cb962ac59075b964b07152d234b70', 'lost@turkhackteam.org', 'İsim', 'Soyisim', '9.12.2020 20:41', '10.12.2020 9:05', 0),
(2, 'deneme', '202cb962ac59075b964b07152d234b70', 'deneme@turkhackteam.org', 'Ahmet', 'Ahmetoğlu', '09.12.2020 22.4', '09.12.2020 22.4', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `ust_kategori_id` int(10) UNSIGNED NOT NULL,
  `kategori_seflink` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(3) UNSIGNED NOT NULL,
  `tr` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `en` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `br` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `ust_kategori_id`, `kategori_seflink`, `aktif`, `tr`, `en`, `br`) VALUES
(1, 0, 'kategori-1', 1, 'Kategori 1', 'Category 1', NULL),
(2, 0, 'alt-kategori-1', 1, 'Alt Kategori 1', '', NULL),
(3, 0, 'deneme', 1, 'deneme', 'try', NULL),
(4, 0, 'deneme', 1, 'deneme', 'try', NULL),
(5, 0, 'deneme-kategori', 1, 'deneme1', 'deneme2', 'deneme3'),
(6, 0, 'deneme-kategori', 1, 'deneme1', 'deneme2', 'deneme3');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `urun_adet` int(11) NOT NULL,
  `sepet_siparis_notu` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`id`, `kullanici_id`, `urun_id`, `urun_adet`, `sepet_siparis_notu`) VALUES
(1, 1, 1, 2, 'deneme not'),
(2, 1, 3, 10, 'deneme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `siparis_numarasi` int(11) NOT NULL,
  `musteri_id` int(11) NOT NULL,
  `toplam_tutar` float NOT NULL,
  `kargo_ucreti` float NOT NULL,
  `adres` text COLLATE utf8_turkish_ci NOT NULL,
  `siparis_tarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `siparis_durum` int(11) NOT NULL,
  `ip_adresi` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `kargo_takip_no` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `token` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`siparis_numarasi`, `musteri_id`, `toplam_tutar`, `kargo_ucreti`, `adres`, `siparis_tarihi`, `siparis_durum`, `ip_adresi`, `kargo_takip_no`, `token`) VALUES
(1, 1, 10, 9.9, 'deneme adres', '10.12.2020', 1, '192.168.1.1', '51685189', 'asd2846-asAS-asd2a1s68-asdsddd'),
(2, 1, 50, 9, 'deneme adres', '10.12.2020 05.5', 0, '::1', '0', '21564-53165-53156-51586-5154'),
(3, 1, 50, 9, 'deneme adres', '10.12.2020 13.10', 0, '::1', '0', '21564-52165-53156-51586-5154');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis_urunler`
--

CREATE TABLE `siparis_urunler` (
  `id` int(11) NOT NULL,
  `siparis_id` int(11) NOT NULL,
  `urun_stok_kodu` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `urun_adedi` int(11) NOT NULL,
  `urun_tutari` float NOT NULL,
  `siparis_notu` text COLLATE utf8_turkish_ci NOT NULL,
  `siparis_eden_id` int(11) NOT NULL,
  `siparis_tarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `siparis_urun_durum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparis_urunler`
--

INSERT INTO `siparis_urunler` (`id`, `siparis_id`, `urun_stok_kodu`, `urun_adedi`, `urun_tutari`, `siparis_notu`, `siparis_eden_id`, `siparis_tarihi`, `siparis_urun_durum`) VALUES
(1, 1, 'APP_001', 5, 50000, 'Gri Renk', 1, '10.12.2020 06.2', 0),
(2, 1, 'APP_001', 5, 50000, 'Gri Renk', 1, '10.12.2020 13.17', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_ayar`
--

CREATE TABLE `site_ayar` (
  `id` int(11) NOT NULL,
  `favicon` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `baslik` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `meta_baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `meta_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `ziyaret_araligi` int(11) NOT NULL,
  `sosyal_fb` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sosyal_tw` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sosyal_ig` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `whatsapp` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `duyuru` text COLLATE utf8_turkish_ci NOT NULL,
  `varsayilan_dil` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `bakim_modu` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `site_ayar`
--

INSERT INTO `site_ayar` (`id`, `favicon`, `baslik`, `slogan`, `logo`, `meta_baslik`, `meta_icerik`, `ziyaret_araligi`, `sosyal_fb`, `sosyal_tw`, `sosyal_ig`, `whatsapp`, `duyuru`, `varsayilan_dil`, `bakim_modu`) VALUES
(1, 'assets/img/favicon.ico', 'E-Ticaret Sitesi', 'Ucuz ve Kaliteli Ürünler Burada!', 'assets/img/logo.png', 'E-Ticaret Sitesi - Ucuz ve Kaliteli Ürünler Burada!', 'En uygun fiyata en kaliteli ürünleri bizim sitemizden alabilirsiniz.', 1, 'facebook.com', 'twitter.com', 'instagram.com', '+90 538 853 564 1122', '30 TL ve üzeri alışverişlerde kargo bedava!', 'tr', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `urun_aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `urun_aciklama_detay` text COLLATE utf8_turkish_ci NOT NULL,
  `urun_ozellikler` text COLLATE utf8_turkish_ci NOT NULL,
  `urun_etiket` text COLLATE utf8_turkish_ci NOT NULL,
  `indirim_durum` tinyint(4) NOT NULL DEFAULT 0,
  `indirim_degeri` int(11) NOT NULL DEFAULT 0,
  `urun_fiyat` float NOT NULL,
  `urun_kategori_id` int(11) NOT NULL DEFAULT 1,
  `urun_resim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `urun_stok_kodu` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `urun_stok` int(11) NOT NULL,
  `eklenme_tarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `yayin_durum` tinyint(4) NOT NULL,
  `gosterim_sayisi` int(11) NOT NULL DEFAULT 0,
  `puan_1` int(11) NOT NULL DEFAULT 0,
  `puan_2` int(11) NOT NULL DEFAULT 0,
  `puan_3` int(11) NOT NULL DEFAULT 0,
  `puan_4` int(11) NOT NULL DEFAULT 0,
  `puan_5` int(11) NOT NULL DEFAULT 0,
  `toplam_satis` int(11) NOT NULL DEFAULT 0,
  `ust_urun_id` int(11) NOT NULL DEFAULT 0,
  `varyant_grup` int(11) DEFAULT 0,
  `varyant_urun_ad` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `iade_durum` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urun_adi`, `urun_aciklama`, `urun_aciklama_detay`, `urun_ozellikler`, `urun_etiket`, `indirim_durum`, `indirim_degeri`, `urun_fiyat`, `urun_kategori_id`, `urun_resim`, `urun_stok_kodu`, `urun_stok`, `eklenme_tarihi`, `yayin_durum`, `gosterim_sayisi`, `puan_1`, `puan_2`, `puan_3`, `puan_4`, `puan_5`, `toplam_satis`, `ust_urun_id`, `varyant_grup`, `varyant_urun_ad`, `iade_durum`) VALUES
(1, 'MacBook', 'APPLE Macbook Pro 13\"', 'Yüksek çözünürlüklü Retina ekran Apple MacBook Pro 2020 Sonu', '1,5 GB Ekran kartı 8GB RAM 2K Çözünürlülük', 'macbook,pro,apple,laptop,dizüstü', 1, 50, 10000, 1, 'resimler/urun1.png', 'APP-001', 10, '10.12.2020 00.4', 1, 2000, 0, 0, 5, 5, 21, 3, 0, 0, '', 1),
(3, 'iPhone', 'iPhone 6 Plus', 'iPhone Uzay Grisi', '1GB RAM LTE', 'iphone,apple,iphone6,iphone6plus', 1, 50, 6000, 1, 'resimler/urun1.png', 'APP-002', 10, '10.12.2020 02.1', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1),
(4, 'baslik', 'aciklama', 'aciklamaDetay', 'ozellikleri', 'etikler,etiketler,etiketler', 1, 10, 100, 1, 'resimler/urundeneme.png', 'DNM-001', 20, '10.12.2020 12.18.22', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_resimler`
--

CREATE TABLE `urun_resimler` (
  `id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `resim_yolu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `resim_alt` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun_resimler`
--

INSERT INTO `urun_resimler` (`id`, `urun_id`, `resim_yolu`, `resim_alt`) VALUES
(1, 1, 'resimler/resim1.png', 'resim1'),
(2, 1, 'resimler/resim2.png', 'resim2'),
(3, 1, 'resimler/deneme123.png', 'deneme123 resmi'),
(4, 1, 'resimler/deneme123.png', 'deneme123 resmi'),
(5, 1, 'resimler/deneme123.png', 'deneme123 resmi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `varyasyonlar`
--

CREATE TABLE `varyasyonlar` (
  `id` int(11) NOT NULL,
  `varyant_ad` varchar(30) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `varyasyonlar`
--

INSERT INTO `varyasyonlar` (`id`, `varyant_ad`) VALUES
(1, 'Renk'),
(2, 'Beden'),
(3, 'Uzunluk'),
(4, 'Genişlik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `puan` int(11) NOT NULL,
  `isim_durum` tinyint(4) NOT NULL,
  `yorum_baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `yorum_tarih` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `kullanici_id`, `urun_id`, `puan`, `isim_durum`, `yorum_baslik`, `yorum_icerik`, `yorum_tarih`) VALUES
(1, 1, 1, 5, 1, 'Sevdim', 'Uzun süredir MacBook Air kullanıyordum Pro almak için sattım pişman değilim.', '10.12.2020 08.42'),
(2, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 09.56'),
(3, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.02'),
(4, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.02'),
(5, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.03'),
(6, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.05'),
(7, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.06'),
(8, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.06'),
(9, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.07'),
(10, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.07'),
(11, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.08'),
(12, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.08'),
(13, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.08'),
(14, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 10.08'),
(15, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 13.46'),
(16, 1, 1, 5, 1, 'Güzel Bir Cihaz', '1 aydır kullanıyorum ısınma sorunu falan olmadı.', '10.12.2020 13.57');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adresler`
--
ALTER TABLE `adresler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `diller`
--
ALTER TABLE `diller`
  ADD PRIMARY KEY (`dil_kodu`);

--
-- Tablo için indeksler `hesaplar`
--
ALTER TABLE `hesaplar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`siparis_numarasi`);

--
-- Tablo için indeksler `siparis_urunler`
--
ALTER TABLE `siparis_urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site_ayar`
--
ALTER TABLE `site_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun_resimler`
--
ALTER TABLE `urun_resimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `varyasyonlar`
--
ALTER TABLE `varyasyonlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adresler`
--
ALTER TABLE `adresler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `hesaplar`
--
ALTER TABLE `hesaplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `siparis_numarasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `siparis_urunler`
--
ALTER TABLE `siparis_urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `site_ayar`
--
ALTER TABLE `site_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `urun_resimler`
--
ALTER TABLE `urun_resimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `varyasyonlar`
--
ALTER TABLE `varyasyonlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
