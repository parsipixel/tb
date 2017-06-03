<?php
/**
 * tb - TelegramTools
 *
 * Initial version by: Ali
 * Initial version created on: 6/4/17
 */

namespace App\Services\Telegram;

/**
 * Class TelegramTools
 * @package App\Services\Telegram
 */
class TelegramTools
{
    const REPLY_INLINE_KEYBOARD = 'inline_keyboard';
    const REPLY_KEYBOARD = 'keyboard';

    /** This object represents an inline keyboard that appears right next to the message it belongs to.
     * @param array $options
     * @return string
     */
    public function buildInlineKeyBoard(array $options)
    {
        $encodedMarkup = json_encode(
            [
                self::REPLY_INLINE_KEYBOARD => $options
            ],
            true);
        return $encodedMarkup;
    }

    /** This object represents an keyboard that appears instead of keyboard.
     * @param array $options
     * @param bool $resizeKeyBoard
     * @param bool $one_time_keyboard
     * @param bool $selective
     * @return string
     */
    public function buildKeyBoard(array $options, $resizeKeyBoard = false, $one_time_keyboard = false, $selective = false)
    {
        $encodedMarkup = json_encode(
            [
                self::REPLY_KEYBOARD => $options,
                'resize_keyboard' => $resizeKeyBoard,
                'one_time_keyboard' => $one_time_keyboard,
                'selective' => $selective
            ],
            true
        );
        return $encodedMarkup;
    }

    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
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
