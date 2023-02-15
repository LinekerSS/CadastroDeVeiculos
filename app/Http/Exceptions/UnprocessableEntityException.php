<?php

namespace App\Http\Exceptions;

use Exception;

class UnprocessableEntityException extends Exception
{

    /**
     * @param string $message
     * @param int $status
     */
    public function __construct(string $message = 'Unprocessable Entity', $status = 422)
    {
        parent::__construct($message, $status);
    }

}
