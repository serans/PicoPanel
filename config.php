<?php
$modules = array();

if(isset($_POST['save_config'])) {
   include('libs/json_utils.php');

//   $config_old = json_decode(file_get_contents($root_dir.'config.json'));
   $config_new = json_decode($_POST['save_config']);

   $config_merged = array_merge((array) $config_new + (array) $config);
   $config_merged_json = json_indent(json_encode($config_merged));
   if(!file_put_contents($root_dir.'config.json', $config_merged_json)) header("HTTP/1.0 404 Not Found");
   else {
      header("HTTP/1.0 200 OK");
      echo "OK";
   }
   die();
}

function sortModules($a, $b) {
   return ($a['name'] < $b['name'])? 1:-1;
}

foreach (scandir("./modules/") as $file) {
   if(preg_match("/\.php$/",$file)) {
      include "./modules/".$file;
      $modules[] = underscore_to_camelcase(basename($file,'.php'));
   }
}

renderPage('config');
