<?php
/**
 * The Mysql file.
 */
namespace mani\blog\persistence;

use mani\blog\model\Model;

/**
 * Class Mysql
 *
 * @package mani\blog\persistene
 */
class Mysql extends Persistence
{
    /**
     * @return Persistence
     */
    public function persist()
    {
        // TODO: Implement persist() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @param string $object
     *
     * @return Persistence
     */
    public function from($object)
    {
        // TODO: Implement from() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @return Model
     */
    public function getOne()
    {
        // TODO: Implement getOne() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @return Model[]
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @param array $fields
     * @param array $values
     *
     * @return Persistence
     */
    public function where(array $fields, array $values)
    {
        // TODO: Implement where() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @return Persistence
     */
    public function select()
    {
        // TODO: Implement select() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @return Model
     */
    public function delete()
    {
        // TODO: Implement delete() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

    /**
     * @return Persistence
     */
    public function update($values)
    {
        // TODO: Implement update() method.
        throw new \Exception(self::ERROR_NOT_IMPLEMENTED);
    }

}
