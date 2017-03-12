<!DOCTYPE html>
<?php
include_once "classes/Gracenote.php";

$newGrace = new Gracenote('391812539','F71E3A62DE8A51C6E3F9F23382C67FC2','51607514674833791-B2DF4C6201D721E7C08AFCCED0FF6F48');
$genres = $newGrace->getGenres();

?>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $window_title;?> | MÜSCOVER</title>
        <link rel="icon" href="">
        <!--<link rel="stylesheet" type="text/css" href="main.css">-->
    </head>
    <body>