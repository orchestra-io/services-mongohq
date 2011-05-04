<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Mongohq.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';

use orchestra\services\Mongohq;

$obj = new Mongohq($svc['username'], $svc['password']);
$res = $obj->delete(1);

print_r($res);
