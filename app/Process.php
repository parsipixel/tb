<?php
/**
 * tb - Process.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/26/17
 */
namespace App;

use App\Services\Telegram\Handlers\CallbackHandler;
use App\Services\Telegram\Handlers\InlineQueryHandler;
use App\Services\Telegram\Handlers\MessageHandler;
use App\Services\Telegram\Telegram;
use App\Services\Telegram\Update\Update;

/**
 * Class Process
 * @package App
 */
class Process extends Services
{
    public function init()
    {
        if (getenv('USE_WEBHOOK')) {
            $rawData = file_get_contents("php://input");
            try {
                $this->handle((object)json_decode($rawData, true));
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                echo $e->getMessage() . PHP_EOL;
            }
        } else {
            $content = $this->t->getUpdates();
            if ($content) {
//            var_dump($content->result);
//            die();
                foreach ($content->result as $update) {
                    try {
                        $this->handle($update);
                    } catch (\Exception $e) {
                        $this->logger->error($e->getMessage());
                        var_dump($update);
                        echo $e->getMessage() . PHP_EOL;
                    }
                }
            }
        }
    }

    /**
     * @param $update
     */
    public function handle($update)
    {
        if (property_exists($update, 'message')) {
            $update = new Update($update->update_id, $update->message);
            $messageHandler = new MessageHandler($update);
            $messageHandler->handle();
        } elseif (property_exists($update, 'callback_query')) {
            $update = new Update($update->update_id, null, $update->callback_query);
            $callbackHandler = new CallbackHandler($update);
            $callbackHandler->handle();
        } elseif (property_exists($update, 'inline_query')) {
            $update = new Update($update->update_id, null, null, $update->inline_query);
            $inlineQueryHandler = new InlineQueryHandler($update);
            $inlineQueryHandler->handle();
        }
    }
}
