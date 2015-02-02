<?php
/**
 * The Router file.
 */
namespace mani\blog\router;

use mani\blog\Config;
use mani\blog\controller\Controller;
use mani\blog\exception\CustomException;
use mani\blog\exception\ExceptionBadRequest;
use mani\blog\processor\PreProcessor;
use mani\blog\processor\PostProcessor;

/**
 * Class Router
 *
 * @package mani\blog\router
 */
class Router
{
    /**
     * Error constants.
     */
    const ERROR_OBJECT_NOT_FOUND = 'Object not found.';
    const ERROR_REQUEST_METHOD_NO_OPERATION = 'Unknown operation.';

    /**
     * Misc constants.
     */
    const CONTROLLER_PATH = 'mani\\blog\\controller\\';

    /**
     * CRUDL operations.
     */
    const OPERATION_CREATE = 'CREATE';
    const OPERATION_READ = 'READ';
    const OPERATION_UPDATE = 'UPDATE';
    const OPERATION_DELETE = 'DELETE';
    const OPERATION_LISTING = 'LISTING';

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var string
     */
    private $operation;

    /**
     * @var string
     */
    private $object;

    /**
     * @var int
     */
    private $id;

    /**
     * Run the router.
     */
    public function run()
    {
        try {
            $this->resolveRequest();
            $this->object = $this->request->getUri()->getPathPart();
            $this->operation = $this->parseOperation();

            $this->preProcess();
            $this->controllerExecution();
            $this->postProcess();
            $this->output();
        } catch (CustomException $exception) {
            $this->respondWithError($exception);
        }
    }

    /**
     * Resolve the request.
     */
    private function resolveRequest()
    {
        $this->request = new Request();
    }

    /**
     * Gets the operation from the request type.
     *
     * @param string $name             The name of the current endpoint.
     *
     * @return string                  The operation we need to do on the view.
     *
     * @throws ExceptionBadRequest  When the request method cannot be mapped to a valid operation.
     */
    private function parseOperation()
    {
        $requestMethod = $this->request->getMethod();

        if ($requestMethod === Request::REQUEST_METHOD_POST) {
            return self::OPERATION_CREATE;
        } elseif ($requestMethod === Request::REQUEST_METHOD_GET) {
            $this->id = $this->request->getUri()->getPathPart();

            if ($this->id) {
                return self::OPERATION_READ;
            } else {
                return self::OPERATION_LISTING;
            }
        } elseif ($requestMethod === Request::REQUEST_METHOD_PUT) {
            return self::OPERATION_UPDATE;
        } elseif ($requestMethod === Request::REQUEST_METHOD_DELETE) {
            return self::OPERATION_DELETE;
        } else {
            throw new ExceptionBadRequest(self::ERROR_REQUEST_METHOD_NO_OPERATION);
        }
    }

    /**
     * Pre process the request.
     */
    private function preProcess()
    {
        $preProcessorName = Config::get()[Config::PRE_PROCESSOR];
        $preProcessor = new $preProcessorName();
        /** @var $preProcessor PreProcessor */
        $this->request = $preProcessor->process($this->request, $this->operation);
    }

    /**
     * Execute the controller.
     */
    private function controllerExecution()
    {
        $controllerPath = $this->getControllerFullPath();

        if (!class_exists($controllerPath)) {
            throw new ExceptionBadRequest(self::ERROR_OBJECT_NOT_FOUND);
        }

        /** @var Controller $controller */
        $controller = new $controllerPath($this->getPersistenceManager());

        switch ($this->operation) {
            case self::OPERATION_CREATE:
                $this->response = new Response($controller->create($this->request->getProcessedBody()));
                break;
            case self::OPERATION_READ:
                $this->response = new Response($controller->read($this->id));
                break;
            case self::OPERATION_UPDATE:
                $this->response = new Response($controller->update($this->id, $this->request->getProcessedBody()));
                break;
            case self::OPERATION_DELETE:
                $this->response = new Response($controller->delete($this->id));
                break;
            case self::OPERATION_LISTING:
                $this->response = new Response($controller->listing());
                break;
        }
    }

    /**
     * @return mixed
     */
    private function getPersistenceManager()
    {
        $persistanceObject = Config::get()[Config::PERSISTENCE][Config::PERSISTENCE_OBJECT];
        return new $persistanceObject();
    }

    /**
     * @return string
     */
    public function getControllerFullPath()
    {
        return self::CONTROLLER_PATH . ucfirst($this->object);
    }

    /**
     * Post process the request.
     */
    private function postProcess()
    {
        $postProcessorName = Config::get()[Config::POST_PROCESSOR];
        $postProcessor = new $postProcessorName();
        /** @var $postProcessor PostProcessor */
        $this->response = $postProcessor->process($this->response, $this->operation);
    }

    /**
     * @param string $code
     * @param array  $error
     */
    private function respondWithError(CustomException $exception)
    {
        http_response_code($exception->getResponseCode());

        if (Config::get()[Config::ENVIRONMENT] === Config::ENVIRONMENT_DEVELOPMENT) {
            echo $exception->getMessage();
        }
    }

    /**
     * Output from the router.
     */
    private function output()
    {
        header(Response::HEADER_CONTENT_TYPE . ': ' . $this->response->getContentType());
        echo $this->response->getProcessedBody();
    }
} 