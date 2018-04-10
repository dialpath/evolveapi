<?php
/**
 * Get a list of pbxes in an enviornments.
 */

use EvolveAPI\Models\PBX;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$table = new ConsoleTable();

if (!isset($argv[1]))
{
    die("\n\nUsage: php listPbxes.php {environment uuid}\n\n");
}
$api = new PBX($argv[1]);
$api->apiKey = $token;  // Manually set token for testing.

$name = readline("Company Name: ");
$api->create($name);

// Get a list of all carriers for an enviornment and print.
$table->setHeaders(['ID', 'Name', 'Identity', 'Timezone', 'Route']);
$pbxes = $api->all();
foreach ($pbxes as $pbx)
{
    $table->addRow([
        $pbx->uuid,
        $pbx->name,
        $pbx->identity,
        $pbx->timezone,
        $pbx->route
    ]);
}
if (count($pbxes) > 0)
{
    $table->display();
}
else print("\n\nNo Carriers Found\n\n");