<?php
class ActiveConnections extends Module {

   public static function getInfo() {
      return array(
         'name' => 'Active Connections',
         'description' => 'Lists active connections reported by <i>netstat</i>.
                           ESTABLISHED connections are shown in green, TIME_WAIT in grey',
         'version' => 1,
         );
   }

   public static function getData() {
      exec('netstat -n -A inet -t | tail -n+3 | awk \'{print $4 " " $5 " " $6}\'',$netstat);

      $data['connections'] = array();
      $data['connections num_active'] = 0;
      foreach($netstat as $line) {
         $line = explode(" ", $line);
         list($server, $protocol) = explode(":", $line[0]);
         list($host, $host_port) = explode(":", $line[1]);
         $status = $line[2];

         $data['connections'][$host][$status][] = $protocol;

         if($status=="ESTABLISHED") $data['connections num_active']++;
      }
      
      return $data;
   }
}
