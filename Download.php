<?php
    $file = "/images/IMG_7032.MOV";
    header ('Content-type: octet/stream');
    header ('Content-disposition: attachment; filename='.$file.';');
    header('Content-Length: '.filesize($file));
    readfile($file);
    exit;
    ?>
    