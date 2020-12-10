<?php

function mail_kontrol($deger)
{
    $check = true;
    if (!filter_var($deger, FILTER_VALIDATE_EMAIL)) {
        $check = false;
    }
    return $check;
}

function tel_kontrol($deger)
{
    if (strlen($deger) == 10 && is_numeric($deger)) {
        return true;
    } else {
        return false;
    }
}
