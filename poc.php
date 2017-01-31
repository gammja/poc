<?php

function cleanElements($html){
    $search = array(
        "'<script[^>]*?>.*?</script>'si",
        "' on(change|click|mouseover|mouseout|keydown|load)\s?=\s?[\"\'].*?[\"\']([ >])'si",
        "'javascript:\s?(\b).*?([ \"\'])'si"
    );

    $replace = array(
        "",
        "$2",
        "$2"
    );

    $html =  preg_replace($search, $replace, $html);
    return htmlentities($html, ENT_NOQUOTES);
}

function trueCleanElements($html){
    $config = \HTMLPurifier_Config::createDefault();
    $config->set('Cache.DefinitionImpl', null);
    $purifier = new \HTMLPurifier($config);
    $purifiedHtml = $purifier->purify($html);
    return htmlentities($purifiedHtml, ENT_QUOTES);
}


$body = $_GET['payload'];
$purifiedHtml = cleanElements($body);
//$purifiedHtml = trueCleanElements($body);

echo html_entity_decode($purifiedHtml);
//echo  $_GET['payload'];