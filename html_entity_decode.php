<?php

require_once './vendor/autoload.php';

class Version
{
    private $body;

    public function setBody($body)
    {
        $this->body = htmlentities($body, ENT_QUOTES); //<-- twig escape use the native htmlspecialchars function for the HTML escaping strategy.
                                                       // vendor/twig/twig/lib/Twig/Extension/Core.php function twig_escape_filter(..)

//        $this->body = $body; if you use twig autoescape option or escape filter with html escaping strategy, remove htmlentities(..)
        return $this;
    }

    public function getBody()
    {
        return html_entity_decode($this->body);
//        return $this->body; <-- you must remove html_entity_decode(..)
    }
}

//$xss = '<script>alert("xss");</script>';
$xss = '<img src="#" onerror=alert("xss");>'; // some xss payload
$version = new Version();
$version->setBody($xss);

$loader = new Twig_Loader_Array(
    ['index' => '{{ version|raw }}']
//    ['index' => "{{ version }}"] <-- you can remove raw filter
);
$twig = new Twig_Environment($loader);

echo $twig->render('index',
    ['version' => $version->getBody()]
);