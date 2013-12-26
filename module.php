<?php
abstract class Module {

   static public $config = array ();

   static public function getInfo() {
      return array(
         'name' => 'Default Module', 
         'description' => 'Default Module description',
         'version' => 0, 
         );
   }
   
   static public function getData() {
      return null;
   }
   
   static public function render() {
       global $root_dir;
   
       $class = get_called_class();
       $data = $class::getData();
   
       get_called_class();
       $file = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", get_called_class() ));
       include($root_dir.'modules/tpl/'.$file.".tpl.php");
   }
} 
