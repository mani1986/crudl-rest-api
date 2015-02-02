<?php
/**
 * The PreProcessorJson file.
 */
namespace mani\blog\processor;

use mani\blog\router\Request;

/**
 * Class PreProcessorJson
 *
 * @package mani\blog\processor
 */
class PreProcessorJson extends PreProcessor
{
    /**
     * @param Request $request
     *
     * @return Request
     */
    public function processCreate(Request $request)
    {
        $request->setProcessedBody(json_decode($request->getBody(), true));

        return $request;
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function processRead(Request $request)
    {
        return $request;
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function processUpdate(Request $request)
    {
        $request->setProcessedBody(json_decode($request->getBody(), true));

        return $request;
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function processDelete(Request $request)
    {
        return $request;
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function processListing(Request $request)
    {
        return $request;
    }
} 