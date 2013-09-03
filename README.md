# NumberFormat
[![Build Status](https://travis-ci.org/nicmart/NumberFormat.png?branch=master)](https://travis-ci.org/nicmart/NumberFormat)
[![Coverage Status](https://coveralls.io/repos/nicmart/NumberFormat/badge.png?branch=master)](https://coveralls.io/r/nicmart/NumberFormat?branch=master)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/nicmart/NumberFormat/badges/quality-score.png?s=e06818508807c109a8c9354a73fc1a5227426c09)](https://scrutinizer-ci.com/g/nicmart/StringTemplate/)

Helpers to format numbers.

## Install

The best way to install NumberFormat is [through composer](http://getcomposer.org).

Just create a composer.json file for your project:

```JSON
{
    "require": {
        "nicmart/numberformat": "dev-master"
    }
}
```

Then you can run these two commands to install it:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install

or simply run `composer install` if you have have already [installed the composer globally](http://getcomposer.org/doc/00-intro.md#globally).

Then you can include the autoloader, and you will have access to the library classes:

```php
<?php
require 'vendor/autoload.php';
```