<?php
/**
 * The Request file.
 */
namespace mani\blog\router;

use mani\blog\exception\ExceptionBadRequest;

/**
 * Class Request
 *
 * @package mani\blog\router
 */
class Request
{
    /**
     * Error constants.
     */
    const ERROR_HEADER_REQUEST_URI_NOT_SET = 'Request URI not set.';
    const ERROR_BAD_REQUEST = 'Bad request';

    /**
     * Constants to retrieve values from the $_SERVER global variable.
     */
    const REQUEST_REMOTE_ADDRESS = 'REMOTE_ADDR';
    const REQUEST_METHOD = 'REQUEST_METHOD';
    const REQUEST_URI = 'REQUEST_URI';

    /**
     * Request HTTP header constants.
     */
    const HEADER_REQUEST_CUSTOM_SIGNATURE = 'X-Signature';
    const HEADER_REQUEST_CUSTOM_AUTHENTICATION = 'X-Authentication-Token';

    /**
     * The request input path.
     */
    const REQUEST_INPUT = 'php://input';

    /**
     * Request methods.
     */
    const REQUEST_METHOD_GET = 'GET';
    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_PUT = 'PUT';
    const REQUEST_METHOD_UPDATE = 'UPDATE';
    const REQUEST_METHOD_DELETE = 'DELETE';

    /**
     * @var Uri
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $body;

    /**
     * @var mixed
     */
    private $processedBody;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->resolveUri();
        $this->resolveMethod();
        $this->resolveBody();
    }

    /**
     * Resolve request URI.
     */
    private function resolveUri()
    {
        if (isset($_SERVER[self::REQUEST_URI])) {
            $this->uri = new Uri($_SERVER[self::REQUEST_URI]);
        } else {
            throw new ExceptionBadRequest(self::ERROR_BAD_REQUEST);
        }
    }

    /**
     * Resolve request method.
     */
    private function resolveMethod()
    {
        if (isset($_SERVER[self::REQUEST_METHOD])) {
            $this->method = $_SERVER[self::REQUEST_METHOD];
        } else {
            $this->method = self::REQUEST_METHOD_GET;
        }
    }

    /**
     * Store body in the body property.
     */
    protected function resolveBody()
    {
        $this->body = file_get_contents(self::REQUEST_INPUT);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return Uri
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $processedBody
     */
    public function setProcessedBody($processedBody)
    {
        $this->processedBody = $processedBody;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getProcessedBody()
    {
        return $this->processedBody;
    }
}
