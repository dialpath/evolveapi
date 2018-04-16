<?php


namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Sound extends EVCore
{
    protected $environment;

    /**
     * Feature Code constructor.
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
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/sounds/{$uuid}")->sound;
    }

    /**
     * Upload a new Sound File
     * @param string $pbx UUID of the PBX
     * @param string $name Name of the Sound file
     * @param string $description Description of the sound file
     * @param bool $moh Set to true if you want this media file to be music on hold for the PBX
     * @param string $data - Base64 Encoded WAV or MP3 File
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $name, string $description, $moh = false, $data)
    {
        return $this->send("pbx/{$pbx}/sounds", 'POST', [
            'name'        => $name,
            'description' => $description,
            'data'        => $data,
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
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, string $name, string $description, $moh = false, $data)
    {
        return $this->send("pbx/{$pbx}/sounds/{$uuid}", 'POST', [
            'name'        => $name,
            'description' => $description,
            'data'        => $data,
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