<?php
header('Content-Type: image/png');

$nome = $_GET['nome'];
$candidatos = $_GET['candidatos'];
$argh = "?nome=" . $nome . "&candidatos=" . $candidatos;
$mede5 = md5($argh);
$arquivo = "../cola/".$mede5.".png";

if (file_exists($arquivo)) {
	echo imagepng(imagecreatefrompng($arquivo));
}
else {
	$base_url = $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . "/../cola.html" . $argh;
	$image = shell_exec('./wkhtmltoimage --quality 100 --crop-w 600 --crop-h 300 --custom-header "User-Agent" "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:41.0) Gecko/20100101 Firefox/41.0" "'. $base_url . '" ' . $arquivo);
	echo imagepng(imagecreatefrompng($arquivo));
}
?>