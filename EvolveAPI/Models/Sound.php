<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Sound
 * @package EvolveAPI\Models
 */
class Sound extends EVCore
{
    protected $environment;

    /**
     * Sound Files constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of sound files.
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/sounds")->sounds;
    }


    /**
     * Get a Sound File
     * @param string $pbx
     * @param string $uuid
     * @param bool $includeData : specify whether or not to include the audio data to the result
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid, $includeData = false)
    {
        return $this->send("pbx/{$pbx}/sounds/{$uuid}", 'GET', ['withData' => $includeData])->sound;
    }

    /**
     * Upload a new Sound File
     * @param string $pbx UUID of the PBX
     * @param string $name Name of the Sound file
     * @param string $description Description of the sound file
     * @param bool $moh Set to true if you want this media file to be music on hold for the PBX
     * @param string $data - Base64 Encoded WAV or MP3 File
     * @param $ext The extension of the file being uploaded
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $name, string $description, $moh = false, $data, $ext)
    {
        return $this->send("pbx/{$pbx}/sounds", 'POST', [
            'name'        => $name,
            'description' => $description,
            'data'        => $data,
            'ext'         => $ext,
            'isMoh'       => $moh
        ]);

    }

    /**
     * Update a new Sound File
     * @param string $pbx UUID of the PBX
     * @param string $uuid
     * @param string $name Name of the Sound file
     * @param string $description Description of the sound file
     * @param bool $moh Set to true to make this the music on hold for the pbx.
     * @param string $data - Base64 Encoded WAV or MP3 File
     * @param $ext - The extension of the file being uploaded (for conversion)
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, string $name, string $description, $moh = false, $data, $ext)
    {
        return $this->send("pbx/{$pbx}/sounds/{$uuid}", 'PUT', [
            'name'        => $name,
            'description' => $description,
            'data'        => $data,
            'ext'         => $ext,
            'isMoh'       => $moh
        ]);

    }


    /**
     * Remove a sound file
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/sounds/{$uuid}", 'DELETE');
    }
}