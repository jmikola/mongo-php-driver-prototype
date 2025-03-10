--TEST--
PHPC-146: ReadPreference primaryPreferred and secondary swapped
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_live(); ?>
<?php skip_if_not_replica_set(); ?>
<?php skip_if_no_secondary(); ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = create_test_manager();

$bulk = new MongoDB\Driver\BulkWrite();
$bulk->insert(array('my' => 'document'));
$manager->executeBulkWrite(NS, $bulk);

$rps = [
    MongoDB\Driver\ReadPreference::PRIMARY,
    MongoDB\Driver\ReadPreference::PRIMARY_PREFERRED,
    MongoDB\Driver\ReadPreference::SECONDARY,
    MongoDB\Driver\ReadPreference::SECONDARY_PREFERRED,
    MongoDB\Driver\ReadPreference::NEAREST,
];

foreach($rps as $r) {
    $rp = new MongoDB\Driver\ReadPreference($r);
    $cursor = $manager->executeQuery(NS, new MongoDB\Driver\Query(['my' => 'query']), ['readPreference' => $rp]);
    var_dump($cursor);
}

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
object(MongoDB\Driver\Cursor)#%d (%d) {
  ["database"]=>
  string(6) "phongo"
  ["collection"]=>
  string(26) "readPreference_bug0146_001"
  ["query"]=>
  object(MongoDB\Driver\Query)#%d (%d) {
    ["filter"]=>
    object(stdClass)#%d (%d) {
      ["my"]=>
      string(5) "query"
    }
    ["options"]=>
    object(stdClass)#%d (%d) {
    }
    ["readConcern"]=>
    NULL
  }
  ["command"]=>
  NULL
  ["readPreference"]=>
  object(MongoDB\Driver\ReadPreference)#%d (%d) {
    ["mode"]=>
    string(7) "primary"
  }
  ["session"]=>
  NULL
  ["isDead"]=>
  bool(true)
  ["currentIndex"]=>
  int(0)
  ["currentDocument"]=>
  NULL
  ["server"]=>
  object(MongoDB\Driver\Server)#%d (%d) {
    %a
  }
}
object(MongoDB\Driver\Cursor)#%d (%d) {
  ["database"]=>
  string(6) "phongo"
  ["collection"]=>
  string(26) "readPreference_bug0146_001"
  ["query"]=>
  object(MongoDB\Driver\Query)#%d (%d) {
    ["filter"]=>
    object(stdClass)#%d (%d) {
      ["my"]=>
      string(5) "query"
    }
    ["options"]=>
    object(stdClass)#%d (%d) {
    }
    ["readConcern"]=>
    NULL
  }
  ["command"]=>
  NULL
  ["readPreference"]=>
  object(MongoDB\Driver\ReadPreference)#%d (%d) {
    ["mode"]=>
    string(16) "primaryPreferred"
  }
  ["session"]=>
  NULL
  ["isDead"]=>
  bool(true)
  ["currentIndex"]=>
  int(0)
  ["currentDocument"]=>
  NULL
  ["server"]=>
  object(MongoDB\Driver\Server)#%d (%d) {
    %a
  }
}
object(MongoDB\Driver\Cursor)#%d (%d) {
  ["database"]=>
  string(6) "phongo"
  ["collection"]=>
  string(26) "readPreference_bug0146_001"
  ["query"]=>
  object(MongoDB\Driver\Query)#%d (%d) {
    ["filter"]=>
    object(stdClass)#%d (%d) {
      ["my"]=>
      string(5) "query"
    }
    ["options"]=>
    object(stdClass)#%d (%d) {
    }
    ["readConcern"]=>
    NULL
  }
  ["command"]=>
  NULL
  ["readPreference"]=>
  object(MongoDB\Driver\ReadPreference)#%d (%d) {
    ["mode"]=>
    string(9) "secondary"
  }
  ["session"]=>
  NULL
  ["isDead"]=>
  bool(true)
  ["currentIndex"]=>
  int(0)
  ["currentDocument"]=>
  NULL
  ["server"]=>
  object(MongoDB\Driver\Server)#%d (%d) {
    %a
  }
}
object(MongoDB\Driver\Cursor)#%d (%d) {
  ["database"]=>
  string(6) "phongo"
  ["collection"]=>
  string(26) "readPreference_bug0146_001"
  ["query"]=>
  object(MongoDB\Driver\Query)#%d (%d) {
    ["filter"]=>
    object(stdClass)#%d (%d) {
      ["my"]=>
      string(5) "query"
    }
    ["options"]=>
    object(stdClass)#%d (%d) {
    }
    ["readConcern"]=>
    NULL
  }
  ["command"]=>
  NULL
  ["readPreference"]=>
  object(MongoDB\Driver\ReadPreference)#%d (%d) {
    ["mode"]=>
    string(18) "secondaryPreferred"
  }
  ["session"]=>
  NULL
  ["isDead"]=>
  bool(true)
  ["currentIndex"]=>
  int(0)
  ["currentDocument"]=>
  NULL
  ["server"]=>
  object(MongoDB\Driver\Server)#%d (%d) {
    %a
  }
}
object(MongoDB\Driver\Cursor)#%d (%d) {
  ["database"]=>
  string(6) "phongo"
  ["collection"]=>
  string(26) "readPreference_bug0146_001"
  ["query"]=>
  object(MongoDB\Driver\Query)#%d (%d) {
    ["filter"]=>
    object(stdClass)#%d (%d) {
      ["my"]=>
      string(5) "query"
    }
    ["options"]=>
    object(stdClass)#%d (%d) {
    }
    ["readConcern"]=>
    NULL
  }
  ["command"]=>
  NULL
  ["readPreference"]=>
  object(MongoDB\Driver\ReadPreference)#%d (%d) {
    ["mode"]=>
    string(7) "nearest"
  }
  ["session"]=>
  NULL
  ["isDead"]=>
  bool(true)
  ["currentIndex"]=>
  int(0)
  ["currentDocument"]=>
  NULL
  ["server"]=>
  object(MongoDB\Driver\Server)#%d (%d) {
    %a
  }
}
===DONE===
