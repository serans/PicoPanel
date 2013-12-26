<?php
function underscore_to_camelcase( $string, $first_char_caps = true) {
    if( $first_char_caps == true ) {
        $string[0] = strtoupper($string[0]);
    }
    
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $string);
}

function camelcase_to_underscore($string) {
   return strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", $string ));
}
