<?php 
class Top extends Module {

   static public function getInfo() {
      return array(
         'name' => 'Top',
         'description' => 'Shows most cpu-intensive processes',
         'version' => 1,
      );
   }

   static public function getData() {
//      exec('top -b -n 1 | head -n5');
//      exec('top -b -n 1 | tail -n +8 | head -n 5 | awk \'{ print $12 " " $9 " " $10 }\'',$out);
      exec('ps aux | tail -n +2 | sort -r -k 3,3 | head -n 5 | awk \'{ print $11 " " $3 " " $4 }\'',$out);

      foreach($out as $k => $item) {
         $out[$k] = explode(' ',$item);
      }
      return $out;
   }

}
