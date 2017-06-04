<?php
/**
 * tb - Process.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/26/17
 */
namespace App;

use App\Services\Telegram\Telegram;
use App\Services\Telegram\Update\Update;

/**
 * Class Process
 * @package App
 */
class Process extends Services
{
    /**
     * Process constructor.
     */
    public function __construct()
    {
        parent::constructor();
    }

    public function init()
    {
//        $content = $this->t->getUpdates();
//        if ($content) {
//            foreach ($content->result as $update) {
//                $this->handle($update);
//            }
//        }

        $rawData = file_get_contents("php://input");
        $this->handle((object)json_decode($rawData, true));
    }

    /**
     * @param $update
     */
    public function handle($update)
    {
        if (property_exists($update, 'message')) {
            $update = new Update($update->update_id, $update->message);
            $this->messageHandlers($update);
        } elseif (property_exists($update, 'callback_query')) {
            $update = new Update($update->update_id, null, $update->callback_query);
            $this->callbackQueryHandlers($update);
        } elseif (property_exists($update, 'inline_query')) {
            $update = new Update($update->update_id, null, null, $update->inline_query);
            $this->inlineQueryHandlers($update);
        }
    }

    public function messageHandlers(Update $update)
    {
        switch ($update->getMessage()->getText()) {
            case 'ddd':
                $mu = [
                    [
                        $this->t->buildInlineKeyboardButton('1', 'http://tb.app'),
                        $this->t->buildInlineKeyboardButton('2', null, 'Callback_Data')
                    ]
                ];
                $response = $this->t->sendMessage($update->getMessage()->getChat()->getId(), '*SAdddLAM!*', Telegram::MESSAGE_MARKDOWN, $this->t->buildInlineKeyBoard($mu));
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
            case 'Callback_Data':
                $mu = [
                    [
                        $this->t->buildInlineKeyboardButton('text'),
                        $this->t->buildInlineKeyboardButton('lol')
                    ]
                ];
                $response = $this->t->sendMessage(
                    $update->getMessage()->getChat()->getId(),
                    '*CCC!*',
                    Telegram::MESSAGE_MARKDOWN,
                    $this->t->buildKeyBoard($mu, true)
                );
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
//            case 'ddd':
//                $response = $this->t->sendMessage(
//                    $update->getMessage()->getChat()->getId(),
//                    '*SALAM!*',
//                    Telegram::MESSAGE_MARKDOWN,
//                    $this->t->removeKeyBoard()
//                );
//                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
//            case 'ddd':
//                $response = $this->t->sendMessage(
//                    $update->getMessage()->getChat()->getId(),
//                    '*SALAM!*',
//                    Telegram::MESSAGE_MARKDOWN,
//                    $this->t->forceReply()
//                );
//                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
        }
    }

    public function callbackQueryHandlers(Update $update)
    {
        switch ($update->getCallbackQuery()->getData()) {
            case 'Callback_Data':
                $mu = [
                    [
                        $this->t->buildInlineKeyboardButton('1', 'http://tb.app'),
                        $this->t->buildInlineKeyboardButton('2', null, 'Callback_Data')
                    ]
                ];
                $response = $this->t->sendMessage($update->getCallbackQuery()->getMessage()->getChat()->getId(), '_YYYYYY!_', Telegram::MESSAGE_MARKDOWN, $this->t->buildInlineKeyBoard($mu));
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
        }
    }

    public function inlineQueryHandlers(Update $update)
    {
        switch ($update->getInlineQuery()->getQuery()) {
            case '':
            case '2':
            case '3':
                $response = $this->t->answerInlineQuery((string)$update->getInlineQuery()->getId(), json_encode([
                    [
                        'type' => 'article',
                        'id' => '1',
                        'title' => 'RRR',
                        'input_message_content' => [
                            'message_text' => 'EEE'
                        ],
                        'url' => 'http://yahoo.com'
                    ],
                    [
                        'type' => 'article',
                        'id' => '2',
                        'title' => 'WWW',
                        'input_message_content' => [
                            'message_text' => 'EEE'
                        ],
                        'description' => 'aaaaaaaa ...',
                        'thumb_url' => 'https://833b2618.ngrok.io/images/standoff.jpg'
                    ]
                ]));
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
        }
    }
}
