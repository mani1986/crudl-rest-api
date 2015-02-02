<?php
/**
 * The Comment file.
 */
namespace mani\blog\model;

/**
 * Class Comment
 *
 * @package blog\mani\model
 */
class Comment extends Model
{
    /**
     * @var string
     */
    private $blogId;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $author;
}
