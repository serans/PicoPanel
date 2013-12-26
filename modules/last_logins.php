<?php
class LastLogins extends Module {

   public static $config = array(
      'max_len' => array(
         'name' => 'Maximum list length ',
         'value' => 7,
      ),
      'show_all_connected' => array(
         'name' => 'Show all active connections ',
         'desc' => 'If true, shows all active sessions, even if the list exceeds
                    the maximum list length',
         'value' => true,
      ),
   );

   public static function getInfo() {
      return array(
         'name' => 'Last Logins',
         'description' => 'Shows a list of last logged in users. The info is obtained from
                           <i>/var/log/wtmp</i>. Active sessions are highlighted in green',
         'version' => 1);
   }
   
   static public function getData() {
   
      function compareByDatesDesc($a, $b) {

         if( !isset($a['logout_date']) ) {
            if( !isset($b['logout_date']) ) {
               return ($a['login_date'] < $b['login_date'])? 1:-1;
            } else {
               return -1;
            }
         } else {
            if( !isset($b['logout_date']) ) {
               return 1;
            } else {
               return ($a['logout_date'] < $b['logout_date'])? 1:-1;
            }
         }
      }

      $data = array();
      $wtmp = '/var/log/wtmp';
      
      if($fp = fopen($wtmp, 'r')){
         while($buf = fread($fp,384)){
            $access = unpack("Vtype/Vpid",substr($buf,0,8));
            
            if($access['type'] == 8) {
               if( !isset($data['list'][$access['pid']])) {
                  $data['list'][$access['pid']] = array(
                     'pid' => $access['pid'],
                     'user' => '',
                     'host' => '',
                     'date' => ''
                  );            
               }
               $raw_date = unpack("Vterm/Vexit/Vdate/Vuk",substr($buf,332,16));
               $access['date'] = $raw_date['date'];
               $data['list'][$access['pid']]['logout_date'] = $access['date'];
               
            //Logins
            } else if($access['type'] == 7) {
               $access['line'] = substr($buf,8,32);
               $access['inittab'] = substr($buf,40,4);
               $access['user'] = substr($buf,44,32);
               $access['host'] = substr($buf,76,256);
               $raw_date = unpack("Vterm/Vexit/Vdate/Vuk",substr($buf,332,16));
               $access['date'] = $raw_date['date'];
               
               if( !isset($data['list'][$access['pid']]) ) $data['list'][$access['pid']] = array();
               
               $data['list'][$access['pid']]['user'] = isset($access['user'])? $access['user']:'';
               $data['list'][$access['pid']]['host'] = isset($access['host'])? $access['host']:'';
               $data['list'][$access['pid']]['pid']  = isset($access['pid'])? $access['pid']:'';
               $data['list'][$access['pid']]['login_date'] = isset($access['date'])? $access['date']:'';            
            }
         }
         fclose($fp);
      }
      if(!empty($data['list']))      
         usort($data['list'],"compareByDatesDesc");
      return $data;
   }
   
   static public function render() {
      require_once('libs/date_difference.php');
      parent::render();
   }
}
?>
