<?php

require_once 'sp_transaction_test_01.php';
require_once 'PHPUnit.php';

$suite = new PHPUnit_TestSuite("SP_Transaction_Test");
$result = PHPUnit::run($suite);

echo $result->toString();
?>
