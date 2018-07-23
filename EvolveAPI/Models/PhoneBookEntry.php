<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 23-Jul-18
 * Time: 9:09 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class PhoneBookEntry extends EVCore
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
    public function all($pbx, $phoneBook )
    {
        return $this->send("pbx/{$pbx}/phonebooks/{$phoneBook}/entries", 'GET', ['pbx' => $pbx])->entries;
    }

    /**
     * Create a new PhoneBook record
     * @param $pbx
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create($pbx, $phoneBook, array $params)
    {
        return $this->send("pbx/{$pbx}/phonebooks/{$phoneBook}/entries", 'POST', $params);
    }


    /**
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($pbx, $phoneBook, $uuid)
    {
        return $this->send("pbx/{$pbx}/phonebooks/{$phoneBook}/entries/{$uuid}")->entry;
    }


    /**
     * @param $pbx
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($pbx, $phoneBook, $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/phonebooks/{$phoneBook}/entries/$uuid", 'PUT', $params);
    }


    /**
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete($pbx, $phoneBook, $uuid)
    {
        return $this->send("pbx/{$pbx}/phonebooks/{$phoneBook}/entries/$uuid", 'DELETE');
    }
}