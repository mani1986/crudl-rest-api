<?php
/**
 * The PreProcessor file.
 */
namespace mani\blog\processor;

use mani\blog\router\Request;
use mani\blog\router\Router;

/**
 * Class PreProcessor
 *
 * @package mani\blog\processor
 */
abstract class PreProcessor extends Processor
{
    /**
     * @param Request $request
     * @param         $operation
     */
    public function process(Request $request, $operation)
    {
        switch ($operation) {
            case Router::OPERATION_CREATE:
                $request = $this->processCreate($request);
                break;
            case Router::OPERATION_READ:
                $request = $this->processRead($request);
                break;
            case Router::OPERATION_UPDATE:
                $request = $this->processUpdate($request);
                break;
            case Router::OPERATION_DELETE:
                $request = $this->processDelete($request);
                break;
            case Router::OPERATION_LISTING:
                $request = $this->processListing($request);
                break;
        }

        return $request;
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    abstract public function processCreate(Request $request);

    /**
     * @param Request $request
     *
     * @return Request
     */
    abstract public function processRead(Request $request);

    /**
     * @param Request $request
     *
     * @return Request
     */
    abstract public function processUpdate(Request $request);

    /**
     * @param Request $request
     *
     * @return Request
     */
    abstract public function processDelete(Request $request);

    /**
     * @param Request $request
     *
     * @return Request
     */
    abstract public function processListing(Request $request);
}
