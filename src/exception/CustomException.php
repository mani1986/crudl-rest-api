<?php
/**
 * The CustomException file.
 */
namespace mani\blog\exception;

/**
 * Class CustomException
 *
 * @package mani\blog\exception
 */
abstract class CustomException extends \Exception
{
    /**
     * @var int
     */
    protected $responseCode = 403;

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }
}
