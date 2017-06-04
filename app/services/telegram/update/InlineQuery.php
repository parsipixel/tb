<?php
/**
 * tb - ${FILE_NAME}
 *
 * Initial version by: Ali
 * Initial version created on: 6/4/17
 */

namespace App\Services\Telegram\Update;

use App\Services\Telegram\Update\Message\From;

/**
 * Class InlineQuery
 * @package App\Services\Telegram\Update
 */
class InlineQuery
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var From
     */
    public $from;
    /**
     * @var string
     */
    public $query;
    /**
     * @var string
     */
    public $offset;

    /**
     * InlineQuery constructor.
     * @param $inline_query
     */
    public function __construct($inline_query)
    {
        $this->id = $inline_query->id;
        $this->from = new From((object)$inline_query->from);
        $this->query = $inline_query->query;
        $this->offset = $inline_query->offset;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return From
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param From $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param string $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }
}
