<?php
/**
 * The View file.
 */
namespace mani\blog\view;

use blog\mani\model\Model;
use mani\blog\router\Request;

/**
 * Class View
 *
 * @package mani\blog\view
 */
abstract class View
{
    /**
     * @param Model $model
     *
     * @return mixed
     */
    abstract protected function getObject(Model $model);

    /**
     * @param Request $request
     */
    protected function processRead(Request $request) {

    }
}
