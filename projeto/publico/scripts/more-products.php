<?php

require 'connection-db.php';

$offset = $_GET['offset'];
$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT A.Codigo, A.Titulo AS Titulo, A.Descricao, A.Preco AS Preco, 
    (SELECT NomeArqFoto FROM Foto F WHERE F.CodAnuncio = A.Codigo LIMIT 1) AS NomeArqFoto
    FROM Anuncio A
    LIMIT 6 OFFSET ?
SQL;
try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$offset]);
    $produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($produtos);

    //$products = array();
    //while()

}
catch(Exception $e){
    exit('Unexpected error'. $e->getMessage());
}



?>