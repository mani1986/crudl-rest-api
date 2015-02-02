<?php
/**
 * The ExceptionUnauthorized file.
 */
namespace mani\blog\exception;

/**
 * Class ExceptionUnauthorized
 *
 * @package mani\blog\exception
 */
class ExceptionUnauthorized extends CustomException
{
    /**
     * @var int
     */
    protected $responseCode = 401;
}

