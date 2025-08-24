<?php
if(! function_exists("my_hash")){
    function my_hash(String $text, $length = 16){
        return substr(md5($text), 0, $length);
    }
}
?>