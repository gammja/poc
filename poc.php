<?php

require_once './vendor/autoload.php';

$body = $_GET['payload'];

$config = \HTMLPurifier_Config::createDefault();
$config->set('Cache.DefinitionImpl', null);
$purifier = new \HTMLPurifier($config);
$purifiedHtml = $purifier->purify($body);
$body = htmlentities($purifiedHtml, ENT_QUOTES);

echo html_entity_decode($body);

//echo  $_GET['payload'];