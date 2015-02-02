<?php
/**
 * The Blog file.
 */
namespace mani\blog\model;

/**
 * Class Blog
 *
 * @package blog\mani\model
 */
class Blog extends Model
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var User
     */
    private $author;

    /**
     * @var string
     */
    private $date;
}
