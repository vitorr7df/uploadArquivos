<?php
function conectaDB() {
    $banco = '/home/siap/vitor.fdb';
    $pdo = new PDO("firebird:dbname=localhost:$banco;charset=utf8;", "SYSDBA", 'masterkey');
    $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
    return $pdo;
}
?>