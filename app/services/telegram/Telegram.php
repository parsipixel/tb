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
    const GET_CHAT = 'getChat';
    const SET_WEBHOOK = 'setWebhook';
    const DELETE_WEBHOOK = 'deleteWebhook';
    const SEND_MESSAGE = 'sendMessage';
    const DELETE_MESSAGE = 'deleteMessage';
    const ANSWER_INLINE_QUERY = 'answerInlineQuery';

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
        $params = [];
        $response = $this->client->send(new Request('post', $this->get(self::GET_UPDATES)), ['form_params' => $params]);
        $content = json_decode($response->getBody()->getContents());
        if ($response->getStatusCode() == 200 && $content->ok) {
            return $content;
        }
        return false;
    }

    /**
     * @param $chatId
     * @return bool|mixed
     */
    public function getChat($chatId)
    {
        $params = [
            'chat_id' => $chatId
        ];
        $response = $this->client->send(new Request('post', $this->get(self::GET_CHAT)), ['form_params' => $params]);
        return $response;
    }

    /**
     * @param $chatId
     * @param $messageId
     * @return bool|mixed
     */
    public function deleteMessage($chatId, $messageId)
    {
        $params = [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ];
        $response = $this->client->send(new Request('post', $this->get(self::DELETE_MESSAGE)), ['form_params' => $params]);
        return $response;
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

    public function answerInlineQuery($inline_query_id, $results, $cache_time = null, $is_personal = null, $next_offset = null, $switch_pm_text = null, $switch_pm_paramete = null)
    {
        $params = [
            'inline_query_id' => $inline_query_id,
            'results' => $results
        ];
        $response = $this->client->send(new Request('post', $this->get(self::ANSWER_INLINE_QUERY)), ['form_params' => $params]);
        return $response;
    }
}
