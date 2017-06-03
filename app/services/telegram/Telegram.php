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
class Telegram
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
            $params['reply_markup'] = $this->buildInlineKeyBoard($reply_markup);
        }

        $response = $this->client->send(new Request('post', $this->get(self::SEND_MESSAGE)), ['form_params' => $params]);
        return $response;
    }

    /// Set an InlineKeyBoard
    /** This object represents an inline keyboard that appears right next to the message it belongs to.
     * \param $options Array of Array of InlineKeyboardButton; Array of button rows, each represented by an Array of InlineKeyboardButton
     * \return the requested keyboard as Json
     * @param array $options
     * @return string
     */
    public function buildInlineKeyBoard(array $options)
    {
        $replyMarkup = [
            'inline_keyboard' => $options,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }

    /// Create an InlineKeyboardButton
    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $url String Optional. HTTP url to be opened when button is pressed
     * \param $callback_data String Optional. Data to be sent in a callback query to the bot when button is pressed
     * \param $switch_inline_query String Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the bot’s username will be inserted.
     * \param $switch_inline_query_current_chat String Optional. Optional. If set, pressing the button will insert the bot‘s username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot’s username will be inserted.
     * \param $callback_game  String Optional. Description of the game that will be launched when the user presses the button.
     * \param $pay  Boolean Optional. Specify True, to send a <a href="https://core.telegram.org/bots/api#payments">Pay button</a>.
     * \return the requested button as Array
     * @param $text
     * @param string $url
     * @param string $callback_data
     * @param string $switch_inline_query
     * @param string $switch_inline_query_current_chat
     * @param string $callback_game
     * @param string $pay
     * @return array
     */
    public function buildInlineKeyboardButton($text, $url = "", $callback_data = "", $switch_inline_query = "", $switch_inline_query_current_chat = "", $callback_game = "", $pay = "")
    {
        $replyMarkup = [
            'text' => $text
        ];
        if ($url) {
            $replyMarkup['url'] = $url;
        } else if ($callback_data) {
            $replyMarkup['callback_data'] = $callback_data;
        } else if ($switch_inline_query) {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        } else if ($switch_inline_query_current_chat) {
            $replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        } else if ($callback_game) {
            $replyMarkup['callback_game'] = $callback_game;
        } else if ($pay) {
            $replyMarkup['pay'] = $pay;
        }
        return $replyMarkup;
    }
}
