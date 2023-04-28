<?php

session_start();

//DESTROY REMEMBER ME COOKIE

setcookie("userId","",time()- 8640 * 7);

setcookie("check_confirm_real","",time() - 8640 * 70);


setcookie("Lazer_wave_last_visited_page","",time() -8640 *7);



setcookie("Cookie_consent", "", time()  + 86400 * 1);


session_destroy();

header("location:index.php");
exit;