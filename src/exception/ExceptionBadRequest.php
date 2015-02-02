<?php
/**
 * The ExceptionBadRequest file.
 */
namespace mani\blog\exception;

/**
 * Class ExceptionBadRequest
 *
 * @package mani\blog\exception
 */
class ExceptionBadRequest extends CustomException
{
    /**
     * @var int
     */
    protected $responseCode = 400;
}
