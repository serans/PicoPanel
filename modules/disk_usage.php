<?php 
class DiskUsage extends Module {

   static public function getInfo() {
      return array(
         'name' => 'Disk Usage',
         'description' => 'Estimates file space usage of all devices mounted on 
                           <i>/media/</i>, <i>/mnt</i> as well as the root directory',
         'version' => 1,
         );
   }

   static public function getData() {
      $data = array();
      
      exec('df -h / /media/* /mnt/* | tail -n+2 | sort | uniq | awk {\'print $2 " " $3 " " $5 " " $6\'}',$du);
      foreach($du as $disk){
         list($dtotal, $dfree, $dusage, $dname) = explode(" ",$disk);
         $data[] = array (
            "total" => $dtotal,
            "free"  => $dfree,
            "usage" => $dusage,
            "name"  => $dname,
         );
      }
      return $data;
   }
   
}
