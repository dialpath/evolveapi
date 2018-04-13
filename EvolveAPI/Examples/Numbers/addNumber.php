<?php

use EvolveAPI\Models\Number;
use EvolveAPI\Models\PBX;
use LucidFrame\Console\ConsoleTable;

include("../../../vendor/autoload.php");
include("../config.php");


$table = new ConsoleTable();

if (!isset($argv[1]))
{
    die("\n\nUsage: php addNumber.php {environment uuid}\n\n");
}
$api = new Number($argv[1]);
PBX::$apiKey = $token;  // Manually set token for testing.
$pbx = readline("Enter PBX UUID: ");
$number = readline("Enter 10 Digit Number: ");
$description = readline("Enter a Description (eg. Acme Main Number): ");
// Add the number.

$api->create($pbx, [
    'number'      => $number,
    'description' => $description,
]);


// Get a list of all carriers for an environment and print.
$table->setHeaders(['ID', 'Number', 'Description', 'Recording', 'Email']);
$numbers = $api->all($pbx);
foreach ($numbers as $number)
{
    $table->addRow([
        $number->uuid,
        $number->number,
        $number->description,
        $number->recording,
        $number->email
    ]);
}
if (count($numbers) > 0)
{
    $table->display();
}
else print("\n\nNo Number for PBX Found\n\n");