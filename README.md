# Numbers
[![Build Status](https://travis-ci.org/nicmart/Numbers.png?branch=master)](https://travis-ci.org/nicmart/Numbers)
[![Coverage Status](https://coveralls.io/repos/nicmart/Numbers/badge.png?branch=master)](https://coveralls.io/r/nicmart/Numbers?branch=master)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/nicmart/Numbers/badges/quality-score.png?s=60dc5db3755f1d09789fb05e44bd9b413cf19179)](https://scrutinizer-ci.com/g/nicmart/Numbers/)

Numbers provides a simple and powerful way to convert numbers in various string formats,
like scientific notation or unit-suffix notation. 

It also gives you control on numbers precision
 (that's different of the numbers of decimals!), making it simple to format numbers as you want in your view layer.
 
For installing instructions, please go to the end of this README.

## Usage
First, instantiate an object of the `Number` class. You can do it in two ways: directly or using the `n` static method:
```php
use Numbers\Number;
$n = new Number(3.1415926535898);
$n = Number::n(3.1415926535898);
```
You can then retrieve the underlying float/int value using the `get` method:
```php
var_dump($n->get()); //double(3.1415926535898) 
```

### Significant figures
You can set the number of [significant figures](http://en.wikipedia.org/wiki/Significant_figures) using the method `round`.
```php
$n->round(5)->get(); // returns 3.1416
```

As you can see, the `round` method works differently from the php builtin `round`function, since you are not setting the number of decimals, but the number of significant figures:
```php
(new Number(0.000123456))->round(5)->get(); // returns 0.00012346
```

### Scientific notation
You can easily convert a `Number` to [Scientific Notation](http://en.wikipedia.org/wiki/Scientific_notation):
```php
$sciNotation = Number::n(1234.567)->getSciNotation();
echo $sciNotation->significand; // 1.234567
echo $sciNotation->magnitude; // 4
```
A `SciNotation` objects convert themselves to html when casted to strings:<br>
`(string) Number::n(1234.567)->getSciNotation()` → 1.234567 × 10<sup>4</sup><br>
`(string) Number::n(0.000023)->getSciNotation()` → 2.3 × 10<sup>-5</sup><br>

### Suffix notation
With suffix notation you can convert a number to a format using the [metric prefix notation](http://en.wikipedia.org/wiki/Metric_prefix).
What you will get is a number followed by a suffix that indicates the magnitude of that number, 
using the "kilo", "mega", etc... symbols. All the [SI](http://en.wikipedia.org/wiki/International_System_of_Units) symbols are supported.

```php
// Prints "1.23k"
echo Number::n(1234.567)->round(3)->getPrefixNotation();


// Prints "79G"
echo Number::n(79123232123)->round(2)->getPrefixNotation();


// Prints "123.4µ"
echo Number::n(0.0001234)->getPrefixNotation();
```

### Format with thousands and decimals separator
The `format` method works like `number_format`, but without the hassle of specifying the
number of decimals. The number of significant figures will be used instead. Furthermore, it
will not print trailing zeros in the decimal part.

```php
// Prints "123,123.23"
echo Number::n(123123.23)->format();

// Prints "123 123,23"
echo Number::n(123123.23)->format(',', ' ');

```

### Other functions
#### floor and ceil
```php
// Returns "123123"
Number::n(123123.23)->floor()->get();

// Returns "123124"
Number::n(123123.23)->ceil()->get();

```

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
