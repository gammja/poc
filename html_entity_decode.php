<?php

require_once './vendor/autoload.php';

class Version
{
    private $body;

    public function setBody($body)
    {
//        $this->body = htmlentities($body, ENT_QUOTES);
        $this->body = htmlspecialchars($body, ENT_QUOTES);
        $this->body = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
//        return html_entity_decode($this->body);
    }
}

//$xss = '<script>alert("xss");</script>';
$xss = '<b>test</b><br/><img src="#" onerror=alert("xss");>';

$version = new Version();
$version->setBody($xss);

$loader = new Twig_Loader_Filesystem('/');
$twig = new Twig_Environment($loader);

echo $twig->render('preview_template.html', ['version' => $version->getBody()]);