<?php
namespace PhpJasmine\Matchers\Equality;

use PhpJasmine\Matchers\Matcher;

class ToBeMatcher implements Matcher {

    private $expected;
    private $actual;

    public function __construct($expected = null) {
        $this->expected = $expected;
    }

    public function matches($actual) {
        $this->actual = $actual;

        return $this->expected === $actual;
    }

    public function getFailureMessage() {
        return 'expected ' . var_export($this->expected, true) . ', got ' .
            var_export($this->actual, true);
    }

    public function getNegativeFailureMessage() {
        return 'expected ' . var_export($this->actual, true) . ' not to be '
            . var_export($this->expected, true);
    }
}