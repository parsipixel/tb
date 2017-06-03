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
        $content = $this->t->getUpdates();
        if ($content) {
            foreach ($content->result as $update) {
                $this->handle($update);
            }
        }
    }

    /**
     * @param $update
     */
    public function handle($update)
    {
        $update = new Update($update->update_id, $update->message);
        switch ($update->getMessage()->getText()) {
//            case 'ddd':
//                $mu = [
//                    [
//                        $this->t->buildInlineKeyboardButton('1', 'http://tb.app'),
//                        $this->t->buildInlineKeyboardButton('2', null, 'Callback_Data')
//                    ]
//                ];
//                $response = $this->t->sendMessage($update->getMessage()->getChat()->getId(), '*SALAM!*', Telegram::MESSAGE_MARKDOWN, $mu);
//                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
            case 'ddd':
                $mu = [
                    [
                        $this->t->buildInlineKeyboardButton('text'),
                        $this->t->buildInlineKeyboardButton('lol')
                    ]
                ];
                $response = $this->t->sendMessage(
                    $update->getMessage()->getChat()->getId(),
                    '*SALAM!*',
                    Telegram::MESSAGE_MARKDOWN,
                    $this->t->buildKeyBoard($mu, true)
                );
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
        }
    }
}
