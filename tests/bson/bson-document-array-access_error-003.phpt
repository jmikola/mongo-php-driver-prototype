--TEST--
MongoDB\BSON\Document array access checks types (dimension object handlers)
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

$document = MongoDB\BSON\Document::fromPHP([
    'foo' => 'bar',
    'bar' => 'baz',
    'int64' => new MongoDB\BSON\Int64(123),
]);

echo throws(function() use ($document) {
    $document[0.1];
}, MongoDB\Driver\Exception\RuntimeException::class), "\n";

echo throws(function() use ($document) {
    $document[false];
}, MongoDB\Driver\Exception\RuntimeException::class), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\RuntimeException
Could not find key of type "float" in BSON document
OK: Got MongoDB\Driver\Exception\RuntimeException
Could not find key of type "bool" in BSON document
===DONE===
