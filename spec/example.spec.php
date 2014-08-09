<?php

use PhpJasmine\Matchers\Matcher;

describe('PhpJasmine', function () {
    it('should be easy to write PHP tests', function () {
        expect('writing PHP tests')->not->toBe('difficult');
    });
});

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

\PhpJasmine\Expectations\Expectation::addMatcher('toBeGreaterThan', 'GreaterThanMatcher');

describe('PhpJasmine', function () {
    it('should be easy to write PHP tests', function () {
        expect(5)->toBeGreaterThan(5);
    });
});