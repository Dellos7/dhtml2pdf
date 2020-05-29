<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 3/2/18
 * Time: 15:02
 */

namespace DHtml2Pdf;

require __DIR__ . '/../../vendor/autoload.php';

use DHtml2Pdf\Exception\WkhtmltopdfDriverNotFoundException;
use Knp\Snappy\Pdf;
use Symfony\Component\Process\Exception\InvalidArgumentException;


abstract class WkhtmltopdfOSDriverEnum {
    //const LINUX =  __DIR__ . '/../../vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64';
    const LINUX = __DIR__ . '/../../lib/%s/wkhtmltopdf';
    const OSX = '/usr/local/bin/wkhtmltopdf';
}

class DHtml2Pdf {

    private $pdf;

    function __construct()
    {
        $this->pdf =$this->getWkhtmltopdfFromCurrentOs();
    }

    public function getWkhtmltopdfFromCurrentOs() {
        switch ( PHP_OS ) {
            case "Linux":
                $codename = parse_ini_string(shell_exec('cat /etc/lsb-release'))['DISTRIB_CODENAME'];
                $wkhtmltopdfPath = sprintf( WkhtmltopdfOSDriverEnum::LINUX, $codename );
                if( file_exists( $wkhtmltopdfPath ) ) {
                    return new Pdf( $wkhtmltopdfPath );
                }
                break;
            case "Darwin":
                if( file_exists( WkhtmltopdfOSDriverEnum::OSX ) ) {
                    return  new Pdf( WkhtmltopdfOSDriverEnum::OSX );
                }
                break;
        }
        throw new WkhtmltopdfDriverNotFoundException();
    }

    public function convertHtml2PdfFromUrl( $url ) {
        if( $url ) {
            return $this->pdf->getOutput( $url );
        }
        throw new InvalidArgumentException( 'The param \'url\' is required.' );
    }

}