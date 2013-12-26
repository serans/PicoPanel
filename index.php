<?php
$root_url = dirname($_SERVER['SCRIPT_NAME'])."/";
$root_dir = getcwd()."/";

$config = json_decode(file_get_contents($root_dir.'config.json'));

include('libs/module.php');
include('libs/string_utils.php');

function __autoload($class_name) {
   global $root_dir;
   $filename = camelcase_to_underscore($class_name).".php";

   if (file_exists($root_dir . "modules/" . $filename )) {
      require_once ( $root_dir  . "modules/" . $filename);
      return;
   }
}

$page_title = '';
function renderPage($page_name) {
   global $root_dir, $root_url, $config, $page_title;

   $page_name = $root_dir.'themes/default/'.$page_name.'.tpl.php';
   $page_title = basename($page_name,'.tpl.php');
   
   if(!file_exists($page_name)) {
      header("HTTP/1.0 404 Not Found");
      if(file_exists($root_dir.'themes/default/404.tpl.php')) renderPage("404");
      exit();
   }
   
   ob_start();
   require $page_name;
   $page_content = ob_get_clean();
   
   include($root_dir."themes/default/page.tpl.php");
}

// URLs mapping

if(isset($_GET['m'])) {
   $module = $_GET['m'];
   
   if(isset($_GET['p'])) {
      echo json_encode( call_user_func("$module::getData", $_GET['p']) );
   } else {
      echo json_encode( call_user_func("$module::getData") );
   }
         
} elseif(isset($_GET['section'])) {
  
   if(!file_exists($_GET['section'].'.php')) {
      renderPage('404');
   } else {
      include($_GET['section'].'.php');
   }
   
} elseif(isset($_GET['page'])) {
   renderPage($_GET['page']);
} else {
   renderPAge('index');
}
?>
