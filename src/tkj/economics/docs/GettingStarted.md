#### Getting started

This document briefly goes through the process of installing and setting up this package.

##### Installation

This package available through [packagist](https://packagist.org/packages/tkj/economics):

```bash
$ composer require tkj/economics:~2.0
```

##### Manually

Clone this repository and load the files manually or setup a `spl_autoload`.

##### Connection to Economic

All classes requires a instance of the `ClientInterface` which either can be a the "regular" client which accepts the agreement number, user id and password **(This authentication method will be deprecated by March 15th 2016)**.

###### Agreement number authentication (deprecated by March 15th 2016).

Get your access/tokens from here: https://www.e-conomic.com/developer

```php

use Tkj\Economics\Client;


$client = new Client($agreementNo, $userId, $password, $options=[]);
```

###### Token authentication (Recommended).

```php
use Tkj\Economics\TokenClient;

$client = new TokenClient($token, $appToken, $appIdentifier, $options=[]);
```

###### Options
The options parameter is passed directly to the [SoapClient](http://php.net/manual/en/soapclient.soapclient.php).
