<?php
$modules = array();

function sortModules($a, $b) {
   return ($a['name'] < $b['name'])? 1:-1;
}

function underscoreToCamelCase( $string, $first_char_caps = true)
{
    if( $first_char_caps == true ) {
        $string[0] = strtoupper($string[0]);
    }
    
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $string);
}


foreach (scandir("./modules/") as $file) {
   if(preg_match("/\.php$/",$file)) {
      include "./modules/".$file;
      $modules[] = underscoreToCamelCase(basename($file,'.php'));
   }
}

renderPage('modules');
