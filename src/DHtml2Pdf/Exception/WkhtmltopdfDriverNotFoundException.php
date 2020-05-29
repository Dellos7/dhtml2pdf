<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 3/2/18
 * Time: 15:16
 */

namespace DHtml2Pdf\Exception;
use Exception;

class WkhtmltopdfDriverNotFoundException extends Exception {

    protected $message = 'The wkhtmltopdf driver was not found in the current system. Please verify that it\'s installed';

    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $message = ( $message ? $message : $this->message );
        parent::__construct($message, $code, $previous);
    }

}