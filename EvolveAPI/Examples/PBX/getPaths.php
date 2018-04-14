<?php


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
PBX::$apiKey = $token;  // Manually set token for testing.

$uuid = readline("PBX UUID: ");

// Get a list of all carriers for an enviornment and print.
$cats = $api->availablePaths($uuid);
foreach ($cats as $category => $paths)
{
    print("\n\n-- $category --\n\n");
    $table = new ConsoleTable();
    $table->setHeaders(['UUID', 'Description']);

    foreach ($paths as $path)
    $table->addRow([
        $path->uuid,
        $path->name,
    ]);
    if (count($paths) > 0)
    {
        $table->display();
    }
}

