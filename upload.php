<?php
include_once 'db_connection.php';

$conn = conectaDB();

if(isset($_FILES['file']['name'][0])) {
  $errors = array();
  $success = array();

  $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
  foreach($_FILES['file']['name'] as $key => $name) {
    $tmpName = $_FILES['file']['tmp_name'][$key];
    $size = $_FILES['file']['size'][$key];
    $extension = pathinfo($name, PATHINFO_EXTENSION);

    if(!in_array($extension, $allowedExtensions)) {
      $errors[] = "$name - Extensão não permitida.";
      continue;
    }

    if($size > 1000000) {
      $errors[] = "$name - Arquivo muito grande (tamanho máximo: 1MB).";
      continue;
    }

    $newName = uniqid('', true) . ".$extension";
    $destination = 'imagens/' . $newName;
    
    // Verifica se o diretório de destino existe, caso contrário, cria-o
    if (!file_exists('imagens/')) {
      mkdir('imagens/', 0777, true);
    }

    if(move_uploaded_file($tmpName, $destination)) {
      $success[] = "$name - Enviado com sucesso.";
      $content = addslashes(file_get_contents($destination));
      $sql = "INSERT INTO imagens (nome, tamanho, tipo, conteudo) VALUES ('$newName', '$size', '$extension', '$content')";
      if(mysqli_query($conn, $sql)) {
        $success[] = "$name - Salvo no banco de dados com sucesso.";
      } else {
        $errors[] = "$name - Erro ao salvar no banco de dados: " . mysqli_error($conn);
      }
    } else {
      $errors[] = "$name - Erro ao enviar o arquivo: " . error_get_last()['message'];
    }
  }

  sleep(2);

  if(!empty($errors)) {
    echo "<div class='alert alert-danger'>" . implode("<br>", $errors) . "</div>";
  }

  if(!empty($success)) {
    echo "<div class='alert alert-success'>" . implode("<br>", $success) . "</div>";
  }
}
?>