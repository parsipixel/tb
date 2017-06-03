<?php
/**
 * tb - Process.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/26/17
 */
namespace App;

use App\Services\Services;
use App\Update\Update;

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
        $content = $this->url->getUpdates();
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
            case 'ddd':
                $response = $this->url->sendMessage($update->getMessage()->getChat()->getId(), '*SALAM!*');
                var_dump(json_decode($response->getBody()->getContents())->result);
                die();
        }
    }
}
