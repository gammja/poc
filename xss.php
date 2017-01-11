<?php
$_GET['a'] = 'javascript:alert("xss")';
$href = htmlEntities($_GET['a'], ENT_QUOTES);
echo "<a href='$href'>link</a>"; # results in: <a href='javascript:alert(document.cookie)'>link</a>