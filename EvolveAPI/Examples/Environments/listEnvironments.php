<?php
/**
 * Get a list of enviornments configured for public or private use.
 */

use EvolveAPI\Models\Environment;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$api = new Environment();
$api->apiKey = $token;  // Manually set token for testing.
$table = new ConsoleTable();

// Get a list of all enviornments and print.
$table->setHeaders(['ID', 'Name', 'Location', 'Sandbox', 'SRV Endpoint']);
$envs = $api->all();
foreach ($envs as $env)
{
    $table->addRow([
        $env->uuid,
        $env->name,
        $env->location,
        $env->sandbox ? "Yes" : "No",
        $env->srv_hostname
    ]);
}
$table->display();