--TEST--
MongoDB\Driver\WriteResult::getModifiedCount() with unacknowledged write
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_live(); ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = create_test_manager();

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['x' => 1]);
$bulk->update(['x' => 1], ['$set' => ['y' => 3]]);
$bulk->update(['x' => 2], ['$set' => ['y' => 1]], ['upsert' => true]);
$bulk->update(['x' => 3], ['$set' => ['y' => 2]], ['upsert' => true]);
$bulk->delete(['x' => 1]);

$result = $manager->executeBulkWrite(NS, $bulk, ['writeConcern' => new MongoDB\Driver\WriteConcern(0)]);

var_dump($result->getModifiedCount());

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Deprecated: MongoDB\Driver\WriteResult::getModifiedCount(): Calling MongoDB\Driver\WriteResult::getModifiedCount() for an unacknowledged write is deprecated and will throw an exception in ext-mongodb 2.0 in %s
NULL
===DONE===
