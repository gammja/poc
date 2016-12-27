<?php

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

$v = new Version();
$v->setBody($xss);

echo $v->getBody();