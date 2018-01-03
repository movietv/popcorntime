<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

// Limitar el tiempo de espera
set_time_limit(30000);

// Incluir Scraper
include("imdb.php");

$tt = $_REQUEST["i"];
$i = new IMDb();
$mArr = $i->getMovieInfo($tt);
echo json_encode($mArr);
