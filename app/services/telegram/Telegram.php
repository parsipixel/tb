<?php
/**
 * tb - Url.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services\Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class Url
 * @package App\Services
 */
class Telegram extends TelegramTools
{
    const GET_UPDATES = 'getUpdates';
    const SET_WEBHOOK = 'setWebhook';
    const DELETE_WEBHOOK = 'deleteWebhook';
    const SEND_MESSAGE = 'sendMessage';
    const DELETE_MESSAGE = 'deleteMessage';

    const MESSAGE_MARKDOWN = 'Markdown';
    const MESSAGE_HTML = 'HTML';

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

    /**
     * @param $chatId
     * @param $message
     * @param null $parse_mode
     * @param null $reply_markup
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function sendMessage($chatId, $message, $parse_mode = null, $reply_markup = null)
    {
        $params = [
            'chat_id' => $chatId,
            'text' => $message
        ];

        if ($parse_mode) {
            $params['parse_mode'] = 'Markdown';
        }
        if ($reply_markup) {
            $params['reply_markup'] = $reply_markup;
        }

        $response = $this->client->send(new Request('post', $this->get(self::SEND_MESSAGE)), ['form_params' => $params]);
        return $response;
    }
}
