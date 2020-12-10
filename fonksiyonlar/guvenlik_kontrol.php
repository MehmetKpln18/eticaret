<?php

function filtre($deger)
{
    return strip_tags(trim($deger));
}

function guvenlik_kontrol($deger)
{
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $deger)) {
        return false;
    } else {
        return true;
    }
}
function mail_guvenlik_kontrol($deger)
{
    if (preg_match('/[\'^£$%&*()}{#~?><>,|=+¬]/', $deger)) {
        return false;
    } else {
        return true;
    }
}
function urun_guvenlik_kontrol($deger)
{
    if (preg_match('/[\'^£$%&*()}{#~?><>,|=+¬]/', $deger)) {
        return false;
    } else {
        return true;
    }
}
