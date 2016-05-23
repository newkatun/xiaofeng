<?php
require_once '../ThumbLib.inc.php';
$realpath="../../../uploadfile/2012/04/01333693668.jpg";
$width=300;
$height=200;
try { 
    $thumb = PhpThumbFactory::create($realpath); 
} catch (Exception $e) { 
    // handle error here however you'd like 
} 
$thumb->adaptiveResize($width, $height); 
$thumb->save($realpath);




?>