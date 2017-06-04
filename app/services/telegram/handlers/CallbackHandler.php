<?php
/**
 * tb - CallbackHandler.php
 *
 * Initial version by: Ali
 * Initial version created on: 6/4/17
 */

namespace App\Services\Telegram\Handlers;

use App\Services;
use App\Services\Telegram\Telegram;
use App\Services\Telegram\Update\Update;

/**
 * Class CallbackHandler
 * @package App\Services\Telegram\Handlers
 */
class CallbackHandler extends Services
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
        switch ($this->update->getCallbackQuery()->getData()) {
            case 'Callback_Data':
                $mu = [
                    [
                        $this->t->buildInlineKeyboardButton('1', 'http://tb.app'),
                        $this->t->buildInlineKeyboardButton('2', null, 'Callback_Data')
                    ]
                ];
                $response = $this->t->sendMessage($this->update->getCallbackQuery()->getMessage()->getChat()->getId(), '_YYYYYY!_', Telegram::MESSAGE_MARKDOWN, $this->t->buildInlineKeyBoard($mu));
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
        }
    }
}
