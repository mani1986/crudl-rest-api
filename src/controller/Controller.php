<?php
/**
 * The Controller file.
 */
namespace mani\blog\controller;

use mani\blog\exception\ExceptionNotFound;
use mani\blog\model\Model;
use mani\blog\persistence\Persistence;

/**
 * Class Controller
 *
 * @package mani\blog\controller
 */
abstract class Controller
{
    /**
     * Error constants.
     */
    const ERROR_NOT_IMPLEMENTED = 'Method not implemented.';
    const ERROR_ITEM_NOT_FOUND = 'Item not found.';

    /**
     * @var Persistence
     */
    protected $persistenceManager;

    /**
     * @param Persistence $persistenceManager
     */
    public function __construct(Persistence $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     *
     */
    public function create()
    {

    }

    /**
     * Read a single item.
     *
     * @param $id
     */
    public function read($id)
    {
        $model = $this->persistenceManager->select()->from(get_class($this))->where([Model::FIELD_ID], [$id])->getOne();

        if (count($model) < 1) {
            throw new ExceptionNotFound(self::ERROR_ITEM_NOT_FOUND);
        }

        return $model;
    }

    /**
     * Delete by id.
     *
     * @param $id
     */
    public function delete($id)
    {
        $model = $this->persistenceManager->select()->where([Model::FIELD_ID], [$id])->delete();
    }

    /**
     * List items.
     */
    public function listing()
    {
        $model = $this->persistenceManager->select()->from(get_class($this))->getAll();

        return $model;
    }

    /**
     *
     */
    private function assertAuthenticated()
    {

    }
}
