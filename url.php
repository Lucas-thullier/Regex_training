<?php

$texte = "https://www.openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/917386-les-expressions-regulieres-partie-2-2";
echo preg_replace("#^((https?://)?(w{3})?)?\.[\d\w./-]+\.[a-z]{2,4}[\d\w./_-]*$#", "<a href=$0>$0</a>", $texte);

