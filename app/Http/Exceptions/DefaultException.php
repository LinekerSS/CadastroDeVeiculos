<?php

namespace App\Http\Exceptions;

use Exception;

class DefaultException
{

    protected Exception $error;

    /**
     * @var int|mixed
     */
    protected int $status;

    /**
     * @var string|null
     */
    protected string $message;

    /**
     * @param Exception $error
     * @param string|null $defaultMessage
     * @param int $status
     */
    public function __construct(Exception $error, string $defaultMessage = null, int $status = 500)
    {

        $this->error = $error;

        if(!method_exists($error, 'getStatusCode')) {
            if(httpStatusExists($error->getCode())) {
                $this->status = $error->getCode();
                $this->message = $error->getMessage();
                return $this;
            }

            $this->status = $status;
            $this->message = $defaultMessage ?? getHttpMessage($status);
            return $this;
        }

        $this->status = $error->getStatusCode();
        $this->message = $error->getMessage();
        return $this;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return ['data' => ['error' => $this->message, 'code' => $this->error->getCode() ], 'status' => $this->status];
    }

}