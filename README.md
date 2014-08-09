# PhpJasmine #

PhpJasmine is Jasmine-like testing framework for PHP. For now it's in exploring stage. 

The goal of this project is to write tests as easily as in Jasmine.

[![Build Status](https://travis-ci.org/JanVoracek/phpjasmine.svg?branch=master)](https://travis-ci.org/JanVoracek/phpjasmine)

## Code Sample ##

```php
<?php
describe('PhpJasmine', function () {
    it('should be easy to write PHP tests', function () {
        expect('writing PHP tests')->not->toBe('difficult');
    });
});
```

## Installation ##
It is highly recommended to install PhpJasmine using Composer - [http://getcomposer.org/](http://getcomposer.org/).

Run following commands:
```
$ composer global require janvoracek/phpjasmine:dev-master
```

Try to run `phpjasmine`. If the command is not found, you have to add
`$HOME/.composer/vendor/bin` (Mac) or `%APPDATA%/Composer/bin` (Win) to your PATH.

## Specs ##

PhpJasmine is designed to be as similar as possible to [Jasmine](http://jasmine.github.io/2.0/introduction.html).
The biggest differences are caused by differences between PHP and JS:

 * Different object operator. JS uses "dot" (`.`), PHP uses "arrow" (`->`).
 * The `use` statement for closures. It makes the tests looking not so good. Deal with it :)
 
## Matchers ##

There is for now only basic set of matchers:

# Strict equality matchers #
 * toBe
 * toBeNull
 * toBeTrue
 * toBeFalse

# Loose equality matchers #
 * toEqual
 * toBeEmpty
 * toBeTruthy
 * toBeFalsy

# String matchers #
 * toMatch

# Custom matchers #

It is quiet simple to add custom matcher. Your matcher have to implement 
the PhpJasmine\Matchers\Matcher interface and you have to register it.

Sample matcher:
```php
class GreaterThanMatcher implements Matcher {

    /** @var number */
    private $minimum;
    /** @var number */
    private $actual;

    public function __construct($minimum = null) {
        $this->minimum = $minimum;
    }

    public function matches($actual) {
        $this->actual = $actual;
        return $actual > $this->minimum;
    }

    public function getFailureMessage() {
        return "Expected {$this->actual} to be greater than {$this->minimum}";
    }

    public function getNegativeFailureMessage() {
        return "Expected {$this->actual} not to be greater than {$this->minimum}";
    }
}
```

Registering:
```php
\PhpJasmine\Expectations\Expectation::addMatcher('toBeGreaterThan', 'GreaterThanMatcher');
```

## Mocking ##

There is currently no support for mocking. You can basically use any tool you like.


Copyright (c) 2013 Jan Voracek. This software is licensed under the MIT License.