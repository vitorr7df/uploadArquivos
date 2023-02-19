<?php

require_once 'db_connection.php';

function finalizarUpload() {
  // abre conexão com o banco de dados
  $conn = conectaDB();

  // atualiza o registro na tabela de arquivos para indicar que o upload foi concluído
  $id = $_POST['id'];
  $stmt = $conn->prepare("UPDATE imagens SET uploaded = 1 WHERE id = ?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
}

if (isset($_POST['id'])) {
  finalizarUpload();
}
?>