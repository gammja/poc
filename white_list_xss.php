<?php

require_once './vendor/autoload.php';

class Version
{
    private $body;

    public function setBody($body, $encodeBody = true)
    {
        if (true === $encodeBody) {
            $purifiedHtml = $this->cleanElements($body);
            $body = htmlentities($purifiedHtml, ENT_NOQUOTES);
        }

        $this->body = $body;
        return $this;
    }

    public function getBody()
    {
        return html_entity_decode($this->body);
    }

    protected function cleanElements($html)
    {
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

        return preg_replace($search, $replace, $html);
    }
}

$xss = '<iframe src=javascript&colon;alert&lpar;document&period;location&rpar;>'; // some xss payload
$version = new Version();
$version->setBody($xss);

$loader = new Twig_Loader_Array(
    ['index' => '{{ version|raw }}']
);
$twig = new Twig_Environment($loader);

echo $twig->render('index',
    ['version' => $version->getBody()]
);