<?php
namespace PhpJasmine\Matchers;

use PhpJasmine\Matcher;

class ToEqualMatcher implements Matcher {

    private $expected;
    private $actual;

    const FLOAT_EPSILON = 1e-8;

    public function __construct($expected = null) {
        $this->expected = $expected;
    }

    public function matches($actual) {
        $this->actual = $actual;
        if (is_numeric($this->expected) && is_numeric($actual))
            return (abs($this->expected - $actual) < self::FLOAT_EPSILON);

        return $this->expected == $actual;
    }

    public function getFailureMessage() {
        return 'expected ' . var_export($this->expected, true) . ', got ' .
            var_export($this->actual, true);
    }

    public function getNegativeFailureMessage() {
        return 'expected ' . var_export($this->actual, true) . ' not to equal '
            . var_export($this->expected, true);
    }
}