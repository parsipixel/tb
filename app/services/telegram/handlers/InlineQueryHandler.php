<?php
/**
 * tb - InlineQueryHandler.php
 *
 * Initial version by: Ali
 * Initial version created on: 6/4/17
 */

namespace App\Services\Telegram\Handlers;

use App\Services;
use App\Services\Telegram\Update\Update;

/**
 * Class InlineQueryHandler
 * @package App\Services\Telegram\Handlers
 */
class InlineQueryHandler extends Services
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
        switch ($this->update->getInlineQuery()->getQuery()) {
            case '':
            case '2':
            case '3':
                $response = $this->t->answerInlineQuery((string)$this->update->getInlineQuery()->getId(), json_encode([
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
