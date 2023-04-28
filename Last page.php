<?php

$page = ( $_SERVER["PHP_SELF"]);

$page = str_replace('/',"",$page);
//echo $page;

$cookie_name ="Lazer_wave_last_visited_page";

$cookie_value = $page;

setcookie($cookie_name,$cookie_value, time() + 10800);



/*echo $_COOKIE["Lazer_wave_last_visited_page"];*/



?>