<?php

use EvolveAPI\Models\Extension;
use EvolveAPI\Models\PBX;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$table = new ConsoleTable();

if (!isset($argv[1]))
{
    die("\n\nUsage: php listExtensions.php {environment uuid}\n\n");
}
$api = new Extension($argv[1]);
PBX::$apiKey = $token;  // Manually set token for testing.
$pbx = readline("Enter PBX UUID: ");


// Get a list of all carriers for an environment and print.
$table->setHeaders(['ID', 'Name', 'Extension', 'Caller ID', '911 Caller ID']);
$extensions = $api->all($pbx);
foreach ($extensions as $extension)
{
    $table->addRow([
        $extension->uuid,
        $extension->name,
        $extension->extension,
        $extension->caller_id,
        $extension->emergency_id
    ]);
}
if (count($extensions) > 0)
{
    $table->display();
}
else print("\n\nNo Extensions for PBX Found\n\n");

