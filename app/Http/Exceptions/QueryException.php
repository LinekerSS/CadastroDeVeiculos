<?php

namespace App\Http\Exceptions;

use Exception;

class QueryException extends Exception
{

    /**
     * @param string $message
     * @param int $status
     */
    public function __construct($message = 'An Error Occurred', $status = 500)
    {
        parent::__construct($message, $status);
    }

}
