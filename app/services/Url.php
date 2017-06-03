<?php
/**
 * tb - Url.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class Url
 * @package App\Services
 */
class Url
{
    const GET_UPDATES = 'getUpdates';
    const SET_WEBHOOK = 'setWebhook';
    const DELETE_WEBHOOK = 'deleteWebhook';
    const SEND_MESSAGE = 'sendMessage';
    const DELETE_MESSAGE = 'deleteMessage';

    private $client;

    /**
     * Url constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return string
     */
    public function getTelegramUrl()
    {
        return 'https://api.telegram.org/bot' . TOKEN . '/';
    }

    /**
     * @param $action
     * @return string
     */
    public function get($action)
    {
        return $this->getTelegramUrl() . $action;
    }

    /**
     * @return bool|mixed
     */
    public function getUpdates()
    {
        $response = $this->client->send(new Request('get', $this->get(self::GET_UPDATES)));
        $content = json_decode($response->getBody()->getContents());
        if ($response->getStatusCode() == 200 && $content->ok) {
            return $content;
        }
        return false;
    }
}
