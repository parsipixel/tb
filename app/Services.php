<?php
/**
 * tb - Services.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App;

use Apix\Log\Logger;
use App\Services\Telegram\Telegram;

/**
 * Class Services
 * @package App\Services
 */
class Services
{
    /**
     * @var Telegram
     */
    protected $t;
    /**
     * @var Logger\File
     */
    protected $logger;

    public function constructor()
    {
        $this->t = new Telegram();
        $this->logger = new Logger\File('logs/' . date('Y-m-d') . '.log');
    }
}
