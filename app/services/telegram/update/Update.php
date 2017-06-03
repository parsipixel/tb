<?php
/**
 * tb - Update.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services\Telegram\Update;

use App\Services\Telegram\Update\Message\Message;

/**
 * Class Update
 * @package App\Update
 */
class Update
{
    /**
     * @var int
     */
    private $update_id;
    /**
     * @var Message
     */
    private $message;
    /**
     * @var CallbackQuery
     */
    private $callback_query;

    /**
     * Update constructor.
     * @param $update_id
     * @param $message
     * @param null $callback_query
     */
    public function __construct($update_id, $message = null, $callback_query = null)
    {
        $this->update_id = $update_id;
        if ($message) {
            $this->message = new Message((object)$message);
        }
        if ($callback_query) {
            $this->callback_query = new CallbackQuery((object)$callback_query);
        }
    }

    /**
     * @return int
     */
    public function getUpdateId()
    {
        return $this->update_id;
    }

    /**
     * @param int $update_id
     */
    public function setUpdateId($update_id)
    {
        $this->update_id = $update_id;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return CallbackQuery
     */
    public function getCallbackQuery()
    {
        return $this->callback_query;
    }

    /**
     * @param mixed $callback_query
     */
    public function setCallbackQuery($callback_query)
    {
        $this->callback_query = $callback_query;
    }
}
