<?php
function uploadFile(){
    require_once 'db_connection.php';
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx');
    $max_file_size = 10 * 1024 * 1024; // 10 MB
    $upload_path = 'uploads/';

    // Verifica se o diretório de upload existe, se não, cria-o
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
    }

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (isset($_FILES['file'])) {

        $errors = array();
        $successes = array();

        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($file_size > $max_file_size) {
            $errors[] = "$file_name excede o tamanho máximo permitido de " . ($max_file_size / (1024 * 1024)) . " MB";
        }

        if (!in_array($file_ext, $allowed_extensions)) {
            $errors[] = "$file_name tem uma extensão inválida. São permitidas somente as seguintes extensões: " . implode(', ', $allowed_extensions);
        }

        if (empty($errors)) {
            $file_name = uniqid('file_') . ".$file_ext";
            $file_path = $upload_path . $file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $successes[] = "$file_name foi enviado com sucesso.";

                $sql = "INSERT INTO arquivos (nome) VALUES ('$file_name')";
                $result = mysqli_query($connection, $sql);

                if (!$result) {
                    $errors[] = "Erro ao inserir $file_name no banco de dados: " . mysqli_error($connection);
                }
            } else {
                $errors[] = "Erro ao enviar $file_name.";
            }
        }

        if (!empty($errors)) {
            echo "<div class='alert alert-danger'>" . implode('<br>', $errors) . "</div>";
        }

        if (!empty($successes)) {
            echo "<div class='alert alert-success'>" . implode('<br>', $successes) . "</div>";
        }
    }
}


if (isset($_POST["gravar"])) {
    uploadFile();
}
?>
