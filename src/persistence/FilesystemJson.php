<?php
/**
 * The FilesystemJson file.
 */
namespace mani\blog\persistence;

use mani\blog\Config;
use mani\blog\model\Model;

/**
 * Class FilesystemJson
 *
 * @package mani\blog\persistene
 */
class FilesystemJson extends Persistence
{
    /**
     * Error constants.
     */
    const ERROR_INVALID_WHERE_ARGUMENTS = 'Invalid where arguments.';

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $object;

    /**
     * @var array   Current query.
     */
    private $query;

    /**
     * Construct.
     */
    public function __construct()
    {
        $dataFile = Config::get()[Config::PERSISTENCE][Config::PERSISTENCE_LOCATION];
        $this->data = json_decode(file_get_contents(__DIR__ . '/../../' . $dataFile), true);
    }

    /**
     * @return Persistence
     */
    public function persist()
    {
        $dataFile = Config::get()[Config::PERSISTENCE][Config::PERSISTENCE_LOCATION];
        $this->data = json_encode(file_put_contents(__DIR__ . '/../../' . $dataFile, $this->data));
    }

    /**
     * @param string $object
     *
     * @return Persistence
     */
    public function from($object)
    {
        $objectName = strtolower(end(explode('\\', $object)));

        if (!array_key_exists($objectName, $this->data)) {
            throw new \Exception(vsprintf(self::ERROR_MODEL_NOT_FOUND, [$objectName]));
        }

        $this->query = $this->query[$objectName];
        $this->object = $objectName;

        return $this;
    }

    /**
     * @return Model
     */
    public function getOne()
    {
        return $this->query[0];
    }

    /**
     * @return Model[]
     */
    public function getAll()
    {
        return $this->query;
    }

    /**
     * @param array $fields
     * @param array $values
     *
     * @return Persistence
     */
    public function where(array $fields, array $values)
    {
        if (count($fields) !== count($values)) {
            throw new \Exception(self::ERROR_INVALID_WHERE_ARGUMENTS);
        }

        $i = 0;

        foreach ($fields as $field) {
            foreach ($this->query as $key => $item) {
                if ($item[$field] != $values[$i]) {
                    unset($this->query[$key]);
                }
            }

            $i++;
        }

        $this->query = array_values($this->query);

        return $this;
    }

    /**
     * @return Persistence
     */
    public function select()
    {
        $this->query = $this->data;

        return $this;
    }

    /**
     * @return Model
     */
    public function delete()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return Persistence
     */
    public function update($values)
    {
        // TODO: Implement update() method.
    }
}
