<?php

require "connection-db.php";

class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}

function checkUserCredentials($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT SenhaHash
    FROM Anunciante
    WHERE Email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();

    if (!$senhaHash) 
      return false; 

    if (!password_verify($senha, $senhaHash))
      return false;
      
    return true;
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

function getUserBaseInfo($pdo, $email) {
    $sql = <<<SQL
    SELECT Nome, Codigo
    FROM Anunciante
    WHERE Email = ?
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['username'] = $row['Nome'];
            $_SESSION['usercode'] = $row['Codigo'];
        }
    } catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
}


$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect();
if (checkUserCredentials($pdo, $email, $senha)) {
  
  $cookieParams = session_get_cookie_params();
  $cookieParams['httponly'] = true;
  session_set_cookie_params($cookieParams);
  session_start();
  $_SESSION['loggedIn'] = true;
  $_SESSION['user'] = $email;
  getUserBaseInfo($pdo,$email);

  $response = new RequestResponse(true, '/restrito/home.php');
} 
else
  $response = new RequestResponse(false, ''); 

echo json_encode($response);