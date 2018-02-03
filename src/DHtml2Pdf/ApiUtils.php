<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 3/2/18
 * Time: 15:48
 */

namespace DHtml2Pdf;

abstract class ResultType {
    const DOWNLOAD_PDF = 'download';
    const SHOW_PDF = 'show';
    const GET_PDF_BINARY = 'binary';
}

abstract class ApiError {
    const GENERIC_ERROR = 'An error ocurred.';
    const PDF_CREATE_ERROR = 'An error ocurred creating the PDF.';
    const RESULT_TYPE_PARAM_ERROR = 'Param \'result_type\' is required and must be \'download\', \'show\' or \'binary\'.';
    const URL_PARAM_ERROR = 'Param \'url\' is required.';
    const PDF_BINARY_ERROR = 'Param \'pdf_binary\' is required.';
}

class ApiUtils {

    public static function checkParams( $url, $result_type ) {
        if( !$url ) {
            self::error( ApiError::URL_PARAM_ERROR );
            exit(0);
        }
        if( !$result_type ) {
            self::error( ApiError::RESULT_TYPE_PARAM_ERROR );
            exit(0);
        }
    }

    public static function sendResultFromResultType( $result_type, $pdf_binary, $file_name ) {
        if( !$file_name ) {
            $file_name = 'file';
        }
        if( !$result_type ) {
            self::error( ApiError::RESULT_TYPE_PARAM_ERROR );
        }
        if( !$pdf_binary ) {
            self::error( ApiError::PDF_BINARY_ERROR );
        }
        switch ( $result_type ) {
            case ResultType::DOWNLOAD_PDF:
                self::pdfDownload( $pdf_binary, $file_name );
                break;
            case ResultType::GET_PDF_BINARY:
                self::pdfBinary( $pdf_binary );
                break;
            case ResultType::SHOW_PDF:
                self::pdfShow( $pdf_binary, $file_name );
                break;
            default:
                self::error( ApiError::RESULT_TYPE_PARAM_ERROR );
                exit(0);
                break;
        }
    }

    public static function pdfDownload( $pdfBinary, $fileName ) {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName .'.pdf"');
        echo $pdfBinary;
        exit(0);
    }

    public static function pdfShow( $pdfBinary, $fileName ) {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $fileName .'.pdf"');
        echo $pdfBinary;
        exit(0);
    }

    public static function pdfBinary( $pdfBinary ) {
        header('Access-Control-Allow-Origin: *');
        echo $pdfBinary;
        exit(0);
    }

    public static function error( $errorMessage ) {
        $errorMessage = ( $errorMessage ? $errorMessage : ApiError::GENERIC_ERROR );
        $error = array(
            'res' => 'error',
            'message' => $errorMessage
        );
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        echo json_encode( $error );
    }

}