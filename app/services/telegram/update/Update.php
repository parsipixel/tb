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
     * Update constructor.
     * @param $update_id
     * @param $message
     */
    public function __construct($update_id, $message)
    {
        $this->update_id = $update_id;
        $this->message = new Message($message);
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
}
