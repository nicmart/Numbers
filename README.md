# Numbers
[![Build Status](https://travis-ci.org/nicmart/Numbers.png?branch=master)](https://travis-ci.org/nicmart/Numbers)
[![Coverage Status](https://coveralls.io/repos/nicmart/Numbers/badge.png?branch=master)](https://coveralls.io/r/nicmart/Numbers?branch=master)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/nicmart/Numbers/badges/quality-score.png?s=60dc5db3755f1d09789fb05e44bd9b413cf19179)](https://scrutinizer-ci.com/g/nicmart/Numbers/)

Numbers provides a simple and powerful way to convert numbers in various string formats,
like scientific notation or unit-suffix notation. It also gives you control on numbers precision
 (that's different of the numbers of decimals!), making it simple to format numbers as you want in your view layer.

## Install

The best way to install Numbers is [through composer](http://getcomposer.org).

Just create a composer.json file for your project:

```JSON
{
    "require": {
        "nicmart/numbers": "dev-master"
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