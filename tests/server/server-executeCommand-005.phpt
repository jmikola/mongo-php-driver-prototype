--TEST--
MongoDB\Driver\Server::executeCommand() takes a read preference as legacy option
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_replica_set(); ?>
<?php skip_if_no_secondary(); ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = create_test_manager();

$primaryRp   = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::PRIMARY);
$secondaryRp = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::SECONDARY);

$primary   = $manager->selectServer($primaryRp);
$secondary = $manager->selectServer($secondaryRp);

echo "Testing primary:\n";
$command = new MongoDB\Driver\Command(['ping' => 1]);
$cursor = $primary->executeCommand(DATABASE_NAME, $command, $primaryRp);

echo "is_primary: ", $cursor->getServer()->isPrimary() ? 'true' : 'false', "\n";
echo "is_secondary: ", $cursor->getServer()->isSecondary() ? 'true' : 'false', "\n\n";

echo "Testing secondary:\n";
$command = new MongoDB\Driver\Command(['ping' => 1]);
$cursor = $secondary->executeCommand(DATABASE_NAME, $command, $secondaryRp);

echo "is_primary: ", $cursor->getServer()->isPrimary() ? 'true' : 'false', "\n";
echo "is_secondary: ", $cursor->getServer()->isSecondary() ? 'true' : 'false', "\n\n";
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Testing primary:

Deprecated: MongoDB\Driver\Server::executeCommand(): Passing the "readPreference" option directly is deprecated and will be removed in ext-mongodb 2.0%s
is_primary: true
is_secondary: false

Testing secondary:

Deprecated: MongoDB\Driver\Server::executeCommand(): Passing the "readPreference" option directly is deprecated and will be removed in ext-mongodb 2.0%s
is_primary: false
is_secondary: true

===DONE===
