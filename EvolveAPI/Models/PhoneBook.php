<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 23-Jul-18
 * Time: 4:00 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class PhoneBook extends EVCore
{
    /**
     * PhoneBooks constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of all available phoneBooks
     * @param $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all($pbx)
    {
        return $this->send("phonebooks", 'GET', ['pbx' => $pbx])->phoneBooks;
    }
}