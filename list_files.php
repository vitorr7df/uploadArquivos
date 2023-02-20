<?php 
$filename = $_GET['filename'];
$dir = "imagens/" . $filename;
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      if ($file != "." && $file != ".."){
        echo "<a href=\"".$dir."/".$file."\" target=\"_blank\">".$file."</a><br>\n";
      }
    }
    closedir($dh);
  } else {
    echo "Não foi possível abrir o diretório.";
  }
} else {
  echo "O diretório não existe.";
}
?>
