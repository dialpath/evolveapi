<?php

namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class RouteProfile - PRIVATE ENV ONLY
 *
 * Routing Profile are comprised of a collection of Routing Rules grouped together and assigned to a PBX.
 * This prevents you from having to specifically state each PBXes routing rules. When you are managing a private
 * environment you will most undoubtedly want to create LCR rules for your different carriers. Applying
 * routing profiles to your customers will help organize which carriers are top of the list and which are
 * next in line.
 *
 * All Routing Profiles will have their rules as part of the find() object.
 *
 * @author Chris Horne <chris@dialpath.com>
 * @package EvolveAPI\Models
 */
class RouteProfile extends EVCore
{
    /**
     * Route Profile constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of route profiles.
     */
    public function all()
    {
        return $this->send("profiles")->profiles;
    }

    /**
     * Get a routing profile, its rules, and customers using this profile.
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($uuid)
    {
        return $this->send("profiles/{$uuid}")->profile;
    }

    /**
     * Create a new Route Profile. Once you have built the profile, you
     * can call add/remove rule methods.
     * @param $name
     * @param $description
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create($name, $description)
    {
        return $this->send("profiles", 'POST', [
            'name'        => $name,
            'description' => $description
        ]);
    }

    /**
     * Update the route profile definition. This will not manipulate the rules
     * just update the name of the profile and the description
     * @param $uuid
     * @param $name
     * @param $description
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($uuid, $name, $description)
    {
        return $this->send("profiles/{$uuid}", 'PUT', [
            'name'        => $name,
            'description' => $description
        ]);

    }

    /**
     * Delete a routing profile and its rules.
     * NOTE! If you delete a routing profile and you have pbxes assigned, those
     * PBXes will no longer be able to dial out. Be sure to use the find method
     * to list the pbxes using that route before deletion to prevent downtime.
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete($uuid)
    {
        return $this->send("profiles/{$uuid}", 'DELETE');
    }

    /**
     * Add a new route rule to a profile
     * @param $profile
     * @param array $params
     *   carrier_id : uuid : The carrier to send this call to.
     *   name : string : A name for this rule
     *   regex : string : A regex to match, ie. (.*) would match all.
     *   order : int : The order in which to prioritize this route. You can have
     *     duplicate regex with different carriers with different priority for
     *     redundancy.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function addRule($profile, array $params)
    {
        return $this->send("profiles/{$profile}/rules", 'POST', $params);
    }

    /**
     * Update a rule definition using the same parameters as addRule()
     * @param $profile
     * @param $rule
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function updateRule($profile, $rule, array $params)
    {
        return $this->send("profiles/{$profile}/rules/{$rule}", 'PUT', $params);
    }

    /**
     * Remove a rule.
     * @param $profile
     * @param $rule
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function removeRule($profile, $rule)
    {
        return $this->send("profiles/{$profile}/rules/{$rule}", 'DELETE');
    }
}