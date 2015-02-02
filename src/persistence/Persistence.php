<?php
/**
 * The Persistence file.
 */
namespace mani\blog\persistence;

use mani\blog\model\Model;

/**
 * Class Persistence
 *
 * @package mani\blog\persistene
 */
abstract class Persistence
{
    /**
     * Error constants.
     */
    const ERROR_MODEL_NOT_FOUND = 'Model %s not found';
    const ERROR_NOT_IMPLEMENTED = 'Not implemented';

    /**
     * @return Persistence
     */
    abstract public function persist();

    /**
     * @param string $object
     *
     * @return Persistence
     */
    abstract public function from($object);

    /**
     * @return Model
     */
    abstract public function getOne();

    /**
     * @return Model[]
     */
    abstract public function getAll();

    /**
     * @param array $fields
     * @param array $values
     *
     * @return Persistence
     */
    abstract public function where(array $fields, array $values);

    /**
     * @return Persistence
     */
    abstract public function select();

    /**
     * @return Model
     */
    abstract public function delete();

    /**
     * @return Persistence
     */
    abstract public function update($values);
}
