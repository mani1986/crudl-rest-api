<?php
/**
 * The Router file.
 */
namespace mani\blog\router;

/**
 * Class Response
 *
 * @package mani\blog\router
 */
class Response
{
    /**
     * Content types.
     */
    const CONTENT_TYPE_JSON = 'application/json';

    /**
     * Headers.
     */
    const HEADER_CONTENT_TYPE = 'Content-Type';

    /**
     * @var string
     */
    private $body;

    /**
     * @var mixed
     */
    private $processedBody;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @param array $body
     */
    public function __construct(array $body)
    {
        $this->body = $body;
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

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }
}
