<?php
/**
 * tb - Message.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services\Telegram\Update\Message;

/**
 * Class Message
 * @package App\Update\Message
 */
class Message
{
    /**
     * @var int
     */
    private $message_id;
    /**
     * @var From
     */
    private $from;
    /**
     * @var Chat
     */
    private $chat;
    /**
     * @var int
     */
    private $date;
    /**
     * @var string
     */
    private $text;

    /**
     * Message constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message_id = $message->message_id;
        $this->from = new From((object)$message->from);
        $this->chat = new Chat((object)$message->chat);
        $this->date = $message->date;
        $this->text = $message->text;
    }

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * @param int $message_id
     */
    public function setMessageId($message_id)
    {
        $this->message_id = $message_id;
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
     * @return Chat
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param Chat $chat
     */
    public function setChat($chat)
    {
        $this->chat = $chat;
    }

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}
