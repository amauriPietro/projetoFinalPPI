<?php

function mysqlConnect(){
    require 'config.php';
    $host = $conf_host;
    $dbname = $conf_dbname;
    $username = $conf_username;
    $password = $conf_password;
  $options = [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_PERSISTENT => true, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  try {

    $pdo = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8mb4", $username, $password, $options);

    return $pdo;

  } catch (Exception $e) {

    exit('Falha na conexao com o MySQL: ' . $e->getMessage());

  }
}

?>