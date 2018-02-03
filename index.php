<?php

require __DIR__ . '/vendor/autoload.php';

use Knp\Snappy\Pdf;

$url = $_GET['url'];

if( $url ) {

	$snappy = new Pdf('./vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'); //Creo que no va en mac pero en linux seguramente si

	//$snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
	header('Content-Type: application/pdf');
	header('Content-Disposition: attachment; filename="file.pdf"');
	echo $snappy->getOutput( $url );
	//echo $snappy->getOutput('https://pages-themes.github.io/cayman/'); //Creo que falla por el certificado SSL
}
else {
	echo "Param url not found";
}