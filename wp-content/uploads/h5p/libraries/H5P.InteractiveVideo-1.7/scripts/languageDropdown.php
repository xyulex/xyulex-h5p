<?php

$contentId  = filter_input(INPUT_POST, 'contentId', FILTER_VALIDATE_INT);
$contenido = '';
$idiomaArray = array();
// No contentId
if (!$contentId) {
  return false;
}

$path       = 'c:\xampp\htdocs\wordpress\wp-content\uploads\h5p\content\\'. $contentId .'\videos\\';

if ($gestor = opendir($path)) {
    while (false !== ($entrada = readdir($gestor))) {
      if (strpos($entrada, ".json") !== false) {
        $nombreFichero = explode(".", $entrada);
        $nombreIdioma = explode("_", $nombreFichero[0]);
        $idiomaArray[] = $nombreIdioma[1];
      }
    }
    closedir($gestor);
}

if ($idiomaArray) {
  $contenido = "<a href='#' class='h5p-subtitles-languages-a h5p-subtitlesoff'>OFF</a><br />";

  foreach ($idiomaArray as $idioma) {
    $contenido .= "<a href='#' class='h5p-subtitles-languages-a'>". $idioma . "</a><br />";
  }
}

echo $contenido;
?>