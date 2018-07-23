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
        return $this->send("pbx/{$pbx}/phonebooks", 'GET', ['pbx' => $pbx])->phoneBooks;
    }

    /**
     * Create a new PhoneBook record
     * @param $pbx
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create($pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/phonebooks", 'POST', $params);
    }


    /**
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/phonebooks/{$uuid}")->number;
    }


    /**
     * @param $pbx
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($pbx, $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/phonebooks/$uuid", 'PUT', $params);
    }


    /**
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete($pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/phonebooks/$uuid", 'DELETE');
    }
}