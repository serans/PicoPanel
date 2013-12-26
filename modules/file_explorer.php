<?php
class FileExplorer extends Module {

   public static function getInfo() {
      return array(
         'version' => 1,
         'name' => 'File Explorer',
         'description' => 'Simple ajax file explorer',
      );
   }

   public static function getData($params=null) {
      $params = json_decode($params);

      if(!isset($params))
         $params = (object) array("action"=>"loadFolder", "url"=>".");

      if($params->action == "loadFolder") {
         return self::loadFolder($params->url);
      } else if($params->action == "loadFile") {
         return self::loadFile($params->url);
      } else {
         header("HTTP/1.0 404 Not Found");
         die();
      }
   }

   private static function loadFolder($dir) {
      global $root_dir, $root_url;

      $folders = array();
      $files = array();
      $dir = realpath($dir);

      if(!is_readable($dir)) {
         header("HTTP/1.0 404 Not Found");
         die();
      }

      if ($handle = opendir($dir)) {
         while(false !== ($entry = readdir($handle))) {
            if(is_dir($dir.'/'.$entry)) {
               $folders[] = $dir.'/'.$entry;
            }
            else $files[] = $dir.'/'.$entry;
         }
         closedir($handle);
         sort($files);
         sort($folders);
         $data = array('files' => $files, 'folders' => $folders);
         return $data;
      }
   }
   
   private static function loadFile($file) { 
      global $root_dir, $root_url, $root_url;

      if( !is_readable($file)) {
         header("HTTP/1.0 404 Not Found");
         die();
      } else {
         header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header('Content-Disposition: attachment; filename="' . basename($file) . '"');
         header('Content-Length: ' . filesize($file));
         ob_clean();
         flush();
         readfile($file);
         exit;
      }
      /*
      $file = str_replace($root_dir, $root_url, $file, $count);
      if($count == 0) header("HTTP/1.0 404 Not Found");
      return $file;*/
   }
   
}
