<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Response;

/**
 * Error is a parsed and formatted errornous Google API response.
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class Error
{
    /**
     * @var integer
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * Contructs a new Error object.
     * 
     * @param integer $code
     * @param string $message
     */
    public function __construct($code, $message)
    {
        $this->storeErrorData($code, $message);
    }

    /**
     * Stores the error response code and message.
     * 
     * @param integer $code
     * @param string $message
     */
    protected function storeErrorData($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Gets the response error code.
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Gets the response error message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}