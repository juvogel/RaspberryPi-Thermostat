<?php
    $data = $_POST["data"];
    $file = fopen('thermo/mode', 'w');
    fwrite($file, $data);
    fclose($file);
?>