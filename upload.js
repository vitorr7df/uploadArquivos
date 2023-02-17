$(document).ready(function() {

    var files = [];
  
    $('#file').change(function() {
      files = this.files;
  
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /^image\//;
        if (!imageType.test(file.type)) {
          continue;
        }
  
        var img = document.createElement("img");
        img.classList.add("obj");
        img.file = file;
        var preview = document.getElementById("preview");
        preview.appendChild(img);
  
        var reader = new FileReader();
        reader.onload = (function(aImg) {
          return function(e) {
            aImg.src = e.target.result;
          };
        })(img);
        reader.readAsDataURL(file);
      }
    });
  
    $('#uploadForm').submit(function(e) {
      e.preventDefault();
  
      var formData = new FormData(this);
  
      for (var i = 0; i < files.length; i++) {
        formData.append('file[]', files[i]);
      }
  
      $.ajax({
        url: 'upload.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
              var percent = Math.round((e.loaded / e.total) * 100);
              $('#progress .progress-bar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
            }
          });
          return xhr;
        },
        success: function(data) {
          $('#progress .progress-bar').attr('aria-valuenow', 0).css('width', '0%').text('0%');
          $('#status').html(data);
  
          $.each(files, function(index, file) {
            $('#uploaded-files').append('<tr><td>' + file.name + '</td><td><a href="" class="delete-file" data-name="' + file.name + '">Excluir</a></td></tr>');
          });
  
          files = [];
        }
      });
    });
  
    $(document).on('click', '.delete-file', function(e) {
      e.preventDefault();
      var fileName = $(this).data('name');
      $(this).closest('tr').remove();
    });
  
    $('#btn-cancel').click(function() {
      files = [];
      $('#progress .progress-bar').attr('aria-valuenow', 0).css('width', '0%').text('0%');
      $('#uploaded-files').empty();
      $('#preview').empty();
    });
  });
  