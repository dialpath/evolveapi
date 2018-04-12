<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 4/11/18
 * Time: 7:49 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Number extends EVCore
{


    /**
     * Number constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }


    /**
     * Get a list of assigned telephone numbers.
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $uuid)
    {
        return $this->send("pbx/{$uuid}/numbers")->numbers;
    }

}