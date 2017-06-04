<?php
/**
 * tb - Chat.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services\Telegram\Update\Message;

/**
 * Class Chat
 * @package App\Update\Message
 */
class Chat
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $first_name;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $title;

    /**
     * Chat constructor.
     * @param $chat
     */
    public function __construct($chat)
    {
        $this->id = $chat->id;
        $this->first_name = property_exists($chat, 'first_name') ? $chat->first_name : null;
        $this->username = property_exists($chat, 'username') ? $chat->username : null;
        $this->title = property_exists($chat, 'title') ? $chat->title : null;
        $this->type = $chat->type;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
