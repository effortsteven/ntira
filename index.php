<?php

require __DIR__."/vendor/autoload.php";
require __DIR__."/init.php";

 if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
     return false; 
 } else { 
     require __DIR__."/urls/urls.php";
 }

?>
