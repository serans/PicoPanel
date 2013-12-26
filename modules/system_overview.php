<?php 
class SystemOverview extends Module {

   static public function getInfo() {
      return array(
         'name' => 'System Overview',
         'description' => 'Shows uptime, IP, number of processess and free memory',
         'version' => 1,
      );
   }

   static public function getData() {
      function f1dec($n) {
         return (round($n*10))/10;
      }
      
      // UPTIME
      $data = array();
      $data['uptime']  = array("secs"=>trim(exec("cut -d. -f1 /proc/uptime")));
      $data['uptime']['days'] = floor($data['uptime'] ["secs"]/(60*60*24));
      $data['uptime']['h'] = floor($data['uptime'] ["secs"]/(60*60)%24);
      
      $data['uptime']['m'] = floor($data['uptime'] ["secs"]/(60)%60);
      $data['uptime']['s'] = floor($data['uptime'] ["secs"]%60);
      
      // IP
      $data['ip'] = $_SERVER['SERVER_ADDR'];

      // # PROCESSES
      $data['proc num']  = trim(exec("ps ax | wc -l"));
      
      // MEMORY
      $freemem = intval(exec("cat /proc/meminfo | grep MemFree | awk {'print $2'}"));
      $totalmem = intval(exec("cat /proc/meminfo | grep MemTotal | awk {'print $2'}"));
      $buffers = intval(exec("cat /proc/meminfo | grep Buffers | awk {'print $2'}"));
      $cache = intval(exec("cat /proc/meminfo | grep Cached | awk {'print $2'}"));

      $data['memory'] = array(
          "used" => f1dec(($totalmem-$freemem-$buffers-$cache)/1024),
          "total" => f1dec($totalmem/1024),
          "swap/cache" => f1dec(($buffers+$cache)/1024),
      );
      
      return $data;
   }

}
