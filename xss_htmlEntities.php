<?php
$_GET['a'] = "#000' onload='javascript:alert(\"xss\")";
$href = htmlEntities($_GET['a']);
print "<body bgcolor='$href'>"; # results in: <body bgcolor='#000' onload='alert(document.cookie)'>