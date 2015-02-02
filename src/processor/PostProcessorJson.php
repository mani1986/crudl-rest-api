<?php
/**
 * The PostProcessorJson file.
 */
namespace mani\blog\processor;

use mani\blog\router\Request;
use mani\blog\router\Response;

/**
 * Class PostProcessorJson
 *
 * @package mani\blog\processor
 */
class PostProcessorJson extends PostProcessor
{
    /**
     * @param Response $response
     *
     * @return Response
     */
    public function processCreate(Response $response)
    {
        $response->setContentType(Response::CONTENT_TYPE_JSON);
        $response->setProcessedBody(json_encode($response->getBody()));

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    public function processRead(Response $response)
    {
        $response->setContentType(Response::CONTENT_TYPE_JSON);
        $response->setProcessedBody(json_encode($response->getBody()));

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    public function processUpdate(Response $response)
    {
        $response->setContentType(Response::CONTENT_TYPE_JSON);
        $response->setProcessedBody(json_encode($response->getBody()));

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    public function processDelete(Response $response)
    {
        $response->setContentType(Response::CONTENT_TYPE_JSON);
        $response->setProcessedBody(json_encode($response->getBody()));

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    public function processListing(Response $response)
    {
        $response->setContentType(Response::CONTENT_TYPE_JSON);
        $response->setProcessedBody(json_encode($response->getBody()));

        return $response;
    }
}

