<?php
/**
 * tb - MessageHandler.php
 *
 * Initial version by: Ali
 * Initial version created on: 6/4/17
 */

namespace App\Services\Telegram\Handlers;

use App\Services;
use App\Services\Telegram\Telegram;
use App\Services\Telegram\Update\Update;

/**
 * Class MessageHandler
 * @package App\Services\Telegram\Handlers
 */
class MessageHandler extends Services
{
    /**
     * @var Update
     */
    private $update;

    /**
     * MessageHandler constructor.
     * @param $update
     */
    public function __construct(Update $update)
    {
        parent::__construct();
        $this->update = $update;
    }

    public function handle()
    {
        if ($this->update->getMessage()->getEntities()) {
            foreach ($this->update->getMessage()->getEntities() as $entity) {
                $entity = (object)$entity;
                if ($entity->type == 'url') {
                    $response = $this->t->deleteMessage($this->update->getMessage()->getChat()->getId(), $this->update->getMessage()->getMessageId());
//                    var_dump(json_decode($response->getBody()->getContents())->result);
//                    die();
                }
            }
        }
        switch ($this->update->getMessage()->getText()) {
            case 'ddd':
                $mu = [
                    [
                        $this->t->buildInlineKeyboardButton('1', 'http://tb.app'),
                        $this->t->buildInlineKeyboardButton('2', null, 'Callback_Data')
                    ]
                ];
                $response = $this->t->sendMessage($this->update->getMessage()->getChat()->getId(), '*SAdddLAM!*', Telegram::MESSAGE_MARKDOWN, $this->t->buildInlineKeyBoard($mu));
                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
//            case 'Callback_Data':
//                $mu = [
//                    [
//                        $this->t->buildInlineKeyboardButton('text'),
//                        $this->t->buildInlineKeyboardButton('lol')
//                    ]
//                ];
//                $response = $this->t->sendMessage(
//                    $this->update->getMessage()->getChat()->getId(),
//                    '*CCC!*',
//                    Telegram::MESSAGE_MARKDOWN,
//                    $this->t->buildKeyBoard($mu, true)
//                );
//                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
//            case 'ddd':
//                $response = $this->t->sendMessage(
//                    $this->update->getMessage()->getChat()->getId(),
//                    '*SALAM!*',
//                    Telegram::MESSAGE_MARKDOWN,
//                    $this->t->removeKeyBoard()
//                );
//                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
//            case 'ddd':
//                $response = $this->t->sendMessage(
//                    $this->update->getMessage()->getChat()->getId(),
//                    '*SALAM!*',
//                    Telegram::MESSAGE_MARKDOWN,
//                    $this->t->forceReply()
//                );
//                var_dump(json_decode($response->getBody()->getContents())->result);
//                die();
        }
    }
}
