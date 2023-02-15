<?php

namespace App\Http\Exceptions;

use Exception;

class NotFoundException extends Exception
{

    /**
     * @param string $message
     * @param int $status
     */
    public function __construct($message = 'Nada foi encontrado', $status = 404)
    {
        parent::__construct($message, $status);
    }

}
