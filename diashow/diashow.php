<?php
$pathFunktion = JPATH_SITE . '/modules/lumis_funktionen.php';
JLoader::register('lumis_funktionen', $pathFunktion);
echo JPATH_SITE;
$pfad = "images/galerie/ringe/";
$ausnahme = "index.html";
$ausgabe = @opendir($pfad) or die("$pfad konnte nicht gefunden werden");
echo '<div id="galerie">';

while ($file = readdir($ausgabe))
{
    if(($file!=".") and ($file!="..") and ($file!=$ausnahme ))
    {
        $popUp = '<a href="';
        $popUp = $popUp .$pfad . $file;
        $popUp = $popUp . '" data-lightbox="jh-image-popup">';
        $image = '<img src="';
        $image = $image. $pfad. $file;
        $image = $image. '"';
        $image = $image. ' alt="';
        $file = str_replace(".jpg","",$file);
        $file = str_replace(".JPG","",$file);
        $image = $image. $file;
        $image = $image. '"';
        $image = $image. '/>';
        echo $popUp;
        echo $image;
        echo '</a>';
        echo '<div class="container">';
        echo '<div class="imageDiscription">';
        echo $file;
        echo '</div>';
        echo '<button class="toShopButton">zum Shop</button>';
        echo '</div>';
    }
}
echo '</div>';
closedir($ausgabe);


?>