<?php
/**
 * The PostProcessor file.
 */
namespace mani\blog\processor;

use mani\blog\router\Response;
use mani\blog\router\Router;

/**
 * Class PostProcessor
 *
 * @package mani\blog\processor
 */
abstract class PostProcessor extends Processor
{
    /**
     * @param Response $response
     * @param          $operation
     */
    public function process(Response $response, $operation)
    {
        switch ($operation) {
            case Router::OPERATION_CREATE:
                $response = $this->processCreate($response);
                break;
            case Router::OPERATION_READ:
                $response = $this->processRead($response);
                break;
            case Router::OPERATION_UPDATE:
                $response = $this->processUpdate($response);
                break;
            case Router::OPERATION_DELETE:
                $response = $this->processDelete($response);
                break;
            case Router::OPERATION_LISTING:
                $response = $this->processListing($response);
                break;
        }

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    abstract public function processCreate(Response $response);

    /**
     * @param Response $response
     *
     * @return Response
     */
    abstract public function processRead(Response $response);

    /**
     * @param Response $response
     *
     * @return Response
     */
    abstract public function processUpdate(Response $response);

    /**
     * @param Response $response
     *
     * @return Response
     */
    abstract public function processDelete(Response $response);

    /**
     * @param Response $response
     *
     * @return Response
     */
    abstract public function processListing(Response $response);
}
