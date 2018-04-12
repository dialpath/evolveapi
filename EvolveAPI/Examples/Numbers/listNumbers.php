<?php
/**
 * Get a list of pbxes in an enviornments.
 */

use EvolveAPI\Models\Number;
use EvolveAPI\Models\PBX;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$table = new ConsoleTable();

if (!isset($argv[1]))
{
    die("\n\nUsage: php listNumbers.php {environment uuid}\n\n");
}
$api = new Number($argv[1]);
PBX::$apiKey = $token;  // Manually set token for testing.
$pbx = readline("Enter PBX UUID: ");


// Get a list of all carriers for an environment and print.
$table->setHeaders(['ID', 'Number', 'Description']);
$numbers = $api->all($pbx);
foreach ($numbers as $number)
{
    $table->addRow([
        $number->uuid,
        $number->number,
        $number->description,
    ]);
}
if (count($numbers) > 0)
{
    $table->display();
}
else print("\n\nNo Number for PBX Found\n\n");