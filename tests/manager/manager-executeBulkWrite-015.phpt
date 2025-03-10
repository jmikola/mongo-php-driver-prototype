--TEST--
MongoDB\Driver\Manager::executeBulkWrite() explicit WriteConcern argument is deprecated
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_live(); ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php

require_once __DIR__ . "/../utils/basic.inc";

$manager = create_test_manager();

$bulk = new MongoDB\Driver\BulkWrite();
$bulk->insert(['_id' => 1]);
$manager->executeBulkWrite(NS, $bulk, new MongoDB\Driver\WriteConcern(0));

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Deprecated: MongoDB\Driver\Manager::executeBulkWrite(): Passing the "writeConcern" option directly is deprecated and will be removed in ext-mongodb 2.0%s
===DONE===
