<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Upload de arquivos com jQuery, PHP, Bootstrap e IBexpert</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./upload.css">
</head>

<body>
  <div class="container">
    <div class="page-header">
      <h1>Upload de arquivos</h1>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Selecione os arquivos para upload</h3>
      </div>
      <div class="panel-body">
        <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file">Arquivos:</label>
            <input type="file" name="file[]" id="file" multiple>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Enviar" id="btn-upload">
            <input type="button" class="btn btn-default" value="Cancelar" id="btn-cancel">
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
        <h3 class="panel-title">Arquivos enviados</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Excluir</th>
            </tr>
          </thead>
          <tbody id="uploaded-files">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./upload.js"></script>

</html>