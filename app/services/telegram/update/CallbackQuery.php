<?php
/**
 * tb - CallbackQuery.php
 *
 * Initial version by: Ali
 * Initial version created on: 6/4/17
 */

namespace App\Services\Telegram\Update;

use App\Services\Telegram\Update\Message\From;
use App\Services\Telegram\Update\Message\Message;

/**
 * Class CallbackQuery
 * @package App\Services\Telegram\Update
 */
class CallbackQuery
{
    private $id;
    private $from;
    private $message;
    private $inline_message_id;
    private $chat_instance;
    private $data;
    private $game_short_name;

    /**
     * CallbackQuery constructor.
     * @param $callback_query
     */
    public function __construct($callback_query)
    {
        $this->id = $callback_query->id;
        $this->from = new From((object)$callback_query->from);
        $this->message = new Message((object)$callback_query->message);
        $this->inline_message_id = property_exists($callback_query, 'inline_message_id') ? $callback_query->inline_message_id : null;
        $this->chat_instance = $callback_query->chat_instance;
        $this->data = $callback_query->data;
        $this->game_short_name = property_exists($callback_query, 'game_short_name') ? $callback_query->game_short_name : null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
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
     * @return mixed
     */
    public function getInlineMessageId()
    {
        return $this->inline_message_id;
    }

    /**
     * @param mixed $inline_message_id
     */
    public function setInlineMessageId($inline_message_id)
    {
        $this->inline_message_id = $inline_message_id;
    }

    /**
     * @return mixed
     */
    public function getChatInstance()
    {
        return $this->chat_instance;
    }

    /**
     * @param mixed $chat_instance
     */
    public function setChatInstance($chat_instance)
    {
        $this->chat_instance = $chat_instance;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getGameShortName()
    {
        return $this->game_short_name;
    }

    /**
     * @param mixed $game_short_name
     */
    public function setGameShortName($game_short_name)
    {
        $this->game_short_name = $game_short_name;
    }
}
