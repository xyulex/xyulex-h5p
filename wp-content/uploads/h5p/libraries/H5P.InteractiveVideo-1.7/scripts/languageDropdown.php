<?php

$contentId  = filter_input(INPUT_POST, 'contentId', FILTER_VALIDATE_INT);
$content    = '';
$langArray = array();
// No contentId
if (!$contentId) {
  return false;
}

$path       = 'c:\xampp\htdocs\wordpress\wp-content\uploads\h5p\content\\'. $contentId .'\videos\\';

if ($manager = opendir($path)) {
    while (false !== ($entry = readdir($manager))) {
      if (strpos($entry, ".json") !== false) {
        $filename = explode(".", $entry);
        $langName = explode("_", $filename[0]);
        $langArray[] = $langName[1];
      }
    }
    closedir($manager);
}

if ($langArray) {
  $content = "<a href='#' class='h5p-subtitles-languages-a h5p-subtitlesoff'>OFF</a><br />";

  foreach ($langArray as $lang) {
    $content .= "<a href='#' class='h5p-subtitles-languages-a'>". $lang . "</a><br />";
  }
}

echo $content;
?>
