<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Upload de arquivos com jQuery, PHP, Bootstrap e IBexpert</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="upload.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  
  <div class="container">
    <div class="page-header">
    <button id="alterar-tema" class="botao">Alterar Tema</button>
      <h1>Upload de arquivos</h1>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Selecione os arquivos para upload!</h3>
      </div>
      <div class="panel-body">
        <form class="ajuste-ao-tema" id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file">Arquivos:</label>
            <input type="file" name="file[]" id="file" multiple>
          </div>
          <div class="form-group">
            <label class="ajuste-ao-tema" for="filename">Nome do arquivo:</label>
            <input class="ajuste-ao-tema" type="text" name="filename" id="filename" />
            <input type="submit" class="botao" value="Enviar" id="btn-upload">
            <input type="button" class="botao-cancelar" value="Cancelar" id="btn-cancel">
          </div>
        </form>
        <div id="progress" class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            0%
          </div>
        </div>
      </div>
    </div>
    <div id="status"></div>
    <div id="preview"></div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 id="div-reac" class="panel-title">Arquivos enviados</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead class="ajuste-ao-tema">
            <tr>
              <th>Nome</th>
              <th>Excluir</th>
              <th>Abrir arquivo na pasta</th>
            </tr>
          </thead>
          <tbody id="uploaded-files">
          </tbody>
        </table>
        <button class="botao" id="btnFinalizarUpload">Finalizar Upload</button>
      </div>
    </div>
  </div>
</body>
<script src="./upload.js"></script>
<script>
  $(document).on('click', '#btnFinalizarUpload', function() {
    alert("Upload finalizado com sucesso!");
    location.reload();
  });
</script>

</html>
