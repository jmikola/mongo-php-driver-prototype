--TEST--
MongoDB\Driver\Manager::executeQuery() takes a read preference as legacy option
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_replica_set(); ?>
<?php skip_if_no_secondary(); ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = create_test_manager();

// load fixtures for test
$bulk = new MongoDB\Driver\BulkWrite();
$bulk->insert(['_id' => 1, 'x' => 2, 'y' => 3]);
$manager->executeBulkWrite(NS, $bulk);

$primary   = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::PRIMARY);
$secondary = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::SECONDARY);

echo "Testing primary:\n";
$query = new MongoDB\Driver\Query(['x' => 3], ['projection' => ['y' => 1]]);
$cursor = $manager->executeQuery(NS, $query, $primary);

echo "is_primary: ", $cursor->getServer()->isPrimary() ? 'true' : 'false', "\n";
echo "is_secondary: ", $cursor->getServer()->isSecondary() ? 'true' : 'false', "\n\n";

echo "Testing secondary:\n";
$query = new MongoDB\Driver\Query(['x' => 3], ['projection' => ['y' => 1]]);
$cursor = $manager->executeQuery(NS, $query, $secondary);

echo "is_primary: ", $cursor->getServer()->isPrimary() ? 'true' : 'false', "\n";
echo "is_secondary: ", $cursor->getServer()->isSecondary() ? 'true' : 'false', "\n\n";
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Testing primary:

Deprecated: MongoDB\Driver\Manager::executeQuery(): Passing the "readPreference" option directly is deprecated and will be removed in ext-mongodb 2.0%s
is_primary: true
is_secondary: false

Testing secondary:

Deprecated: MongoDB\Driver\Manager::executeQuery(): Passing the "readPreference" option directly is deprecated and will be removed in ext-mongodb 2.0%s
is_primary: false
is_secondary: true

===DONE===
