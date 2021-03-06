<?php
/**
 * DialPath Evolve PBX API Core Class
 *
 * This class will handle all our method calls to the Dialpath servers and
 * return their corresponding objects.
 *
 * @author Chris Horne <chris@dialpath.com>
 * @version 1.0.0
 * @package Evolve
 */

namespace EvolveAPI;


use Exception;
use GuzzleHttp\Client;

class EVCore
{
    /**
     * Our Evolve API Key
     * @var string
     */
    static public $apiKey = "<< YOUR EVOLVE API KEY >> ";

    /**
     * The Evolve base endpoint. This hopefully won't ever change.
     * @var string
     */
    private $baseEndpoint = "https://www.dialpath.com/api/v1/";
    /**
     * Our Guzzle Client
     * @var
     */
    protected $client;

    protected $environment;

    /**
     * EVCore constructor.
     *
     * Create our Guzzle Instance
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Send the command to the API and return the result.
     * @param $endpoint
     * @param string $method The REST endpoint
     * @param array $params
     * @return mixed
     * @throws EVException
     */
    public function send($endpoint, $method = "get", $params = [])
    {
        $method = strtolower($method);
        if ($this->environment) $this->baseEndpoint .= "environments/{$this->environment}/";
        $this->environment = null; // don't repeat the previous line.
        $data = [];
        $data['headers'] = [
            'X-Auth-Token' => static::$apiKey
        ];
        // Add our form data if we have any to send.
        switch ($method)
        {
            case 'get' :
                $data['query'] = $params;
                break;
            default:
                $data['json'] = $params;
                break;
        }

        try
        {
            $result = $this->client->{$method}($this->baseEndpoint . $endpoint, $data);
            $result = json_decode($result->getBody()->getContents());
            if ($result->success != true) // Error from Evolve API (remote message)
            {
                throw new EVException($result->reason);
            }
            return $result->payload;
        } catch (Exception $e)
        {
            throw new EVException($e->getMessage());
        }
    }


}