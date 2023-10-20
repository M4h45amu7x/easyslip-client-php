<?php

namespace M4h45amu7x\exceptions;

use Error;

class Response
{
    private int $status;
    private string $message;

    /**
     * Response constructor.
     *
     * @param int   $status  Response status
     * @param string $message Response message
     */
    public function __construct(int $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the status of the response.
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Get the message of the response.
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}

class VerifyException extends Error
{
    private Response $response;

    /**
     * Constructs a new XSlipVerifyError with the specified response.
     *
     * @param array $response - The error response from the XSlip API.
     */
    public function __construct($response)
    {
        $this->response = $response;
    }


    /**
     * Get the response of the error.
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }
}
