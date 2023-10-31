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


function createUser($pdo, $nome, $CPF, $email, $senha, $telefone) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO Anunciante (Nome, CPF, Email, SenhaHash, Telefone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $CPF, $email, $senhaHash, $telefone]);

        if ($stmt->rowCount() > 0) {
            return new RequestResponse(true, '/publico/login.html');
        } else {
            return new RequestResponse(false, 'Não consegui cadastrar o usuário....');
        }
    } catch (Exception $e) {
        return new RequestResponse(false, 'Erro ao tentar cadastrar: ' . $e->getMessage());
    }
}

$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? '';
$CPF = $_POST['CPF'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$telefone = $_POST['telefone'] ?? '';


$resposta = createUser($pdo,$nome,$CPF,$email,$senha,$telefone);

echo json_encode($resposta);

?>