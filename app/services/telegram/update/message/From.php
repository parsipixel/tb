<?php
/**
 * tb - From.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services\Telegram\Update\Message;

/**
 * Class From
 * @package App\Update\Message
 */
class From
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
    private $language_code;

    /**
     * From constructor.
     * @param $from
     */
    public function __construct($from)
    {
        $this->id = $from->id;
        $this->first_name = $from->first_name;
        $this->username = $from->username;
        $this->language_code = $from->language_code;
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
    public function getLanguageCode()
    {
        return $this->language_code;
    }

    /**
     * @param string $language_code
     */
    public function setLanguageCode($language_code)
    {
        $this->language_code = $language_code;
    }
}
