<?php
$text = substr(str_shuffle("asdfghjklqwertyuiop"), 4, 6);
$string = rand(100, 1000);

$random = $text . '@' . $string;
echo $random;

?>