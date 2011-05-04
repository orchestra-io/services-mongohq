<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .
             'src' . DIRECTORY_SEPARATOR .
             'Services' . DIRECTORY_SEPARATOR . 'Mongohq.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';

use orchestra\services\Mongohq;

$obj = new Mongohq($svc['username'], $svc['password']);

$res = $obj->add(array(
    'plan' => 'free',
    'app_id' => 'example_mongo_' . time(),
    'callback_url' => 'http://mydomain.com'
));

print_r($res);
