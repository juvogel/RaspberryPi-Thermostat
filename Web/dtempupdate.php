<?php
    $data = $_POST["data"];
    $file = fopen('thermo/dtemp', 'w');
    fwrite($file, $data);
    fclose($file);
?>