<?php
// Função para fazer upload de arquivos
function upload_file($file) {
  // Conecta ao banco de dados
  $pdo = connect_to_database();

  // Lê o conteúdo do arquivo
  $file_data = file_get_contents($file['tmp_name']);

  // Insere os dados do arquivo na tabela
  $stmt = $pdo->prepare('INSERT INTO uploads (filename, filedata) VALUES (:filename, :filedata)');
  $stmt->bindParam(':filename', $file['name']);
  $stmt->bindParam(':filedata', $file_data, PDO::PARAM_LOB);
  $stmt->execute();
}

// Função para conectar ao banco de dados
function connect_to_database() {
  $host = 'localhost';
  $database = '/home/siap/vitor.fdb';
  $user = 'SYSDBA';
  $password = 'masterkey';

  $dsn = "firebird:dbname=$host:$database;charset=UTF8";
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $pdo;
}

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
  // Faz o upload de cada arquivo enviado
  foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
    if (!empty($_FILES['files']['name'][$key])) {
      $file_name = $_FILES['files']['name'][$key];
      $file_size = $_FILES['files']['size'][$key];
      $file_type = $_FILES['files']['type'][$key];
      $file_tmp_name = $_FILES['files']['tmp_name'][$key];
      $file_error = $_FILES['files']['error'][$key];

      // Verifica se houve algum erro no upload
      if ($file_error !== UPLOAD_ERR_OK) {
        echo 'Ocorreu um erro durante o upload do arquivo.';
        exit;
      }

      // Faz o upload do arquivo
      upload_file($_FILES['files']);
    }
  }
}
?>