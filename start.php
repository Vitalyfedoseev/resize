<?php
    require 'vendor/autoload.php';
    require 'src/Resizer.php';
    $resize = new Resizer\Resizer;
    define('ROOT',__DIR__ . '/');
    $resize->run();
?>