<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 3/2/18
 * Time: 15:44
 */

require_once 'src/autoload.php';

use DHtml2Pdf\DHtml2Pdf;
use DHtml2Pdf\ApiUtils;
USE DHtml2Pdf\ApiError;

$url = $_GET['url'];
$resultType = $_GET['result_type'];
$fileName = $_GET['file_name'];

ApiUtils::checkParams( $url, $resultType );

$dhtml2Pdf = new DHtml2Pdf();
try {
    $pdfBinary = $dhtml2Pdf->convertHtml2PdfFromUrl( $url );
    if( $pdfBinary ) {
        ApiUtils::sendResultFromResultType( $resultType, $pdfBinary, $fileName );
    }
    else {
        throw new Exception( ApiError::PDF_CREATE_ERROR );
    }
}
catch( Exception $e ) {
    ApiUtils::error( $e->getMessage() );
}