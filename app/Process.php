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
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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
                $client = new Client();
                $response = $client->send(new Request('post', $this->url->get('sendMessage')), [
                    'form_params' => [
                        'chat_id' => $update->getMessage()->getChat()->getId(),
                        'text' => '111'
                    ]
                ]);
                $content = json_decode($response->getBody()->getContents());
                var_dump($content);
                die();
        }
    }
}
