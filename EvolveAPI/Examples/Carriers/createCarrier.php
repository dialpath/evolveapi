<?php
/**
 * Get a list of enviornments configured for public or private use.
 */

use EvolveAPI\Models\Carrier;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$table = new ConsoleTable();

if (!isset($argv[1]))
{
    die("\n\nUsage: php createCarrier.php {environment uuid}\n\n");
}
$api = new Carrier($argv[1]);
Carrier::$apiKey = $token;  // Manually set token for testing.

// Get a list of all carriers for an enviornment and print.

$data['name'] = readline("Enter Carrier Name: ");
$data['peer'] = readline("Enter Peer Name: (e.g bandwith-one) ");
$data['ip'] = readline("Enter IP for Host: ");

$api->create($data);

$table->setHeaders(['ID', 'Name', 'Peer', 'IP']);
$carriers = $api->all();
foreach ($carriers as $carrier)
{
    $table->addRow([
        $carrier->uuid,
        $carrier->name,
        $carrier->peer,
        $carrier->ip
    ]);
}
if (count($carriers) > 0)
    $table->display();
else print("\n\nNo Carriers Found\n\n");