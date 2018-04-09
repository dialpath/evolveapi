<?php
/**
 * Get a list of servers in an environment (if sandbox or private).
 */

use EvolveAPI\Models\Environment;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$api = new Environment();
$api->apiKey = $token;  // Manually set token for testing.
$table = new ConsoleTable();

if (!isset($argv[1]))
{
    die("\n\nUsage: php getServers.php {uuid of enviornment}\n\n");
}

// Get a list of all enviornments and print.
$table->setHeaders(['UUID', 'Hostname', 'Role', 'Public IP', 'Private IP', 'Description']);
$servers = $api->find($argv[1]);
foreach ($servers as $server)
{
    $table->addRow([
        $server->uuid,
        $server->hostname,
        $server->role,
        $server->public_ip ?: "None Set",
        $server->private_ip ?: "None Set",
        $server->description
    ]);
}
$table->display();