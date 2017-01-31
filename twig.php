<?php

require_once './vendor/autoload.php';

$xss = '<img src="#" onerror=alert("xss");>'; // some xss payload

$loader = new Twig_Loader_Array(
    ['index' => '{{ xss|striptags }}']
);
$twig = new Twig_Environment($loader);

echo $twig->render('index',
    ['xss' => $xss]
);

