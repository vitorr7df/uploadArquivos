<?php

require_once 'db_connection.php';

function finalizarUpload() {
  // abre conexão com o banco de dados
  $pdo = conectaDB();

  // atualiza o registro na tabela de arquivos para indicar que o upload foi concluído
  $stmt = $pdo->prepare("UPDATE files SET uploaded = 1 WHERE id = :id");
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();
}

if (isset($_POST['id'])) {
  finalizarUpload();
}
