<?php
/**
 * The ExceptionNotFound file.
 */
namespace mani\blog\exception;

/**
 * Class ExceptionNotFound
 *
 * @package mani\blog\exception
 */
class ExceptionNotFound extends CustomException
{
    /**
     * @var int
     */
    protected $responseCode = 404;
}
