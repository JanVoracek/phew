# Phew #

Phew is Jasmine-like testing framework for PHP. For now it's in exploring stage.

The goal of this project is to write tests as easily as in Jasmine.

[![Build Status](https://travis-ci.org/JanVoracek/phew.svg?branch=master)](https://travis-ci.org/JanVoracek/phew)

## Code Sample ##

```php
<?php
describe('Phew', function () {
    it('should be easy to write PHP tests', function () {
        expect('writing PHP tests')->not->toBe('difficult');
    });
});
```

## Installation ##
It is highly recommended to install Phew using Composer - [http://getcomposer.org/](http://getcomposer.org/).

Run following commands:
```
$ composer global require janvoracek/phew:dev-master
```

Try to run `phew`. If the command is not found, you have to add
`$HOME/.composer/vendor/bin` (Mac) or `%APPDATA%/Composer/bin` (Win) to your PATH.

## Specs ##

Phew is designed to be as similar as possible to [Jasmine](http://jasmine.github.io/2.0/introduction.html).
The biggest differences are caused by differences between PHP and JS:

 * Different object operator. JS uses "dot" (`.`), PHP uses "arrow" (`->`).
 * The `use` statement for closures. It makes the tests looking not so good. Deal with it :)
 
## Matchers ##

There is for now only basic set of matchers:

### Strict equality matchers ###
 * toBe
 * toBeNull
 * toBeTrue
 * toBeFalse

### Loose equality matchers ###
 * toEqual
 * toBeEmpty
 * toBeTruthy
 * toBeFalsy

### Type matchers ###
 * toBeA
 * toBeAn (alias of toBeA)
 * toBeInstanceOf (alias of toBeA)
 * toImplement (alias of toBeA)

### String matchers ###
 * toStartsWith
 * toMatch

### Custom matchers ###

It is quiet simple to add custom matcher. Your matcher have to implement 
the Phew\Matchers\Matcher interface and you have to register it.

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
\Phew\Expectations\Expectation::addMatcher('toBeGreaterThan', 'GreaterThanMatcher');
```

Copyright (c) 2013 Jan Voracek. This software is licensed under the MIT License.