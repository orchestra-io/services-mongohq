# Synopsis

This package is used to interact with the MongoHQ provider API. As the API evolves, this package
will cover the new methods provided. Currently we can only **add** and **delete**
databases using the MongoHQ API.

# Requirements

  - PHP 5.3.x
  - PECL HTTP 

# Example

Here are a few methods covered by this API wrapper.

## Create new Database

``` php
<?php 
    require_once 'Orchestra/Services/Mongohq.php'; 
    use orchestra\services\Mongohq;

    $svc = new Mongohq('XXX', 'YYY');
    $response = $svc->add(array(
        'plan'         => 'free',
        'app_id'       => 'some-application-name',
	'callback_url' => 'https://my.service.com'
    ));

    echo $response->config->MONGOHQ_URL . PHP_EOL;
    echo $response->id;
?>
```


## Delete a previously created database
``` php
<?php 
    require_once 'Orchestra/Services/Mongohq.php'; 
    use orchestra\services\Mongohq;

    $svc = new Mongohq('XXX', 'YYY');
    $response = $svc->delete('some-id');

    var_dump($response);
?>
```

# License

This is released under the New BSD license. Should you require a copy of the license, it is
included in this very repository.

# Copyright

Orchestra Platform Ltd. 2011

# Links

  - [Orchestra.io](https://orchestra.io)
  - [MongoHQ](http://mongohq.com)


