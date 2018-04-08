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
    private $apiKey = "<< YOUR EVOLVE API KEY >> ";

    /**
     * The Evolve base endpoint. This hopefully won't ever change.
     * @var string
     */
    private $baseEndpoint = "http://localhost:8000/api/v1/";
    /**
     * Our Guzzle Client
     * @var
     */
    protected $client;


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
    public function send($endpoint, $method = "GET", $params = [])
    {
        $method = strtolower($method);
        $data = [];
        $data['headers'] = [
            'X-Auth-Token' => $this->apiKey
        ];
        // Add our form data if we have any to send.
        if ($method != 'GET' && !empty($params))
        {
            $data['json'] = $params;
        }
        try
        {
            $result = $this->client->{$method}($this->baseEndpoint . $endpoint, $data);
            $result = json_decode($result->getBody()->getContents());
            if ($result->success != true) // Error from Evolve API (remote message)
            {
                throw new EVException($result->message);
            }
            return $result->payload;
        } catch (Exception $e)
        {
            throw new EVException("Unable to communicate with the Evolve API: " . $e->getMessage());
        }
    }


}