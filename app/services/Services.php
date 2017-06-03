<?php
/**
 * tb - Services.php
 *
 * Initial version by: Ali
 * Initial version created on: 5/27/17
 */

namespace App\Services;

/**
 * Class Services
 * @package App\Services
 */
class Services
{
    /**
     * @var Url
     */
    public $url;

    public function constructor()
    {
        $this->url = new Url();
    }
}
