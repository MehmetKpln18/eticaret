<?php

class site_ayar
{
    public $site_ayar_sorgu;

    public function __construct()
    {
        require_once("config/baglanti.php");
        $baglanti = new baglanti;
        $db = $baglanti->eticaret();
        $site_ayar = $db->prepare("SELECT * FROM site_ayar LIMIT 1"); // Olası ihtimallere karşı WHERE yerine LIMIT kullanalım.
        $site_ayar->execute();
        $sorgu = $site_ayar->fetch(PDO::FETCH_ASSOC);
        $db = null;
        $this->site_ayar_sorgu = $sorgu;
    }
    public function tum_ayar()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu;
    }
    public function favicon()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["favicon"];
    }
    public function baslik()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["baslik"];
    }
    public function slogan()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["slogan"];
    }
    public function meta_baslik()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["meta_baslik"];
    }
    public function meta_icerik()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["meta_icerik"];
    }
    public function ziyaret_araligi()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["ziyaret_araligi"];
    }
    public function facebook()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["sosyal_fb"];
    }
    public function twitter()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["sosyal_tw"];
    }
    public function instagram()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["sosyal_ig"];
    }
    public function whatsapp()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["whatsapp"];
    }
    public function duyuru()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["duyuru"];
    }
    public function varsayilan_dil()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["varsayilan_dil"];
    }
    public function bakim()
    {
        $sorgu = $this->site_ayar_sorgu;
        return $sorgu["bakim_modu"];
    }
}
