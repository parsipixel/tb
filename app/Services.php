<?php
/**
 * tb - Services.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App;

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
    public $t;

    public function constructor()
    {
        $this->t = new Telegram();
    }
}
