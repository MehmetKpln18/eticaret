<?php

class baglanti
{
  public function eticaret()
  {
    $sorgu = "mysql:host=localhost;dbname=eticaret;charset=utf8";
    $options = [
      PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    try {
      $db = new PDO($sorgu, "root", "", $options);
      return $db;
    } catch (Exception $e) {
      error_log($e->getMessage());
      echo $e;
    }
  }
  public function information_schema()
  {
    $sorgu = "mysql:host=localhost;dbname=information_schema;charset=utf8";
    $options = [
      PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    try {
      $db = new PDO($sorgu, "root", "", $options);
      return $db;
    } catch (Exception $e) {
      error_log($e->getMessage());
      echo $e;
    }
  }
}
