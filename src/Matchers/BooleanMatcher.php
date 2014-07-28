<?php
namespace PhpJasmine\Matchers;

use PhpJasmine\Matcher;

class BooleanMatcher implements Matcher {

    private $expected;
    private $actual;

    public function __construct($expected = null) {
        $this->expected = $expected;
    }

    public function matches($actual) {
        $this->actual = $actual;
        return $this->expected == $actual; // intentionally ==
    }

    public function getFailureMessage() {
        return 'expected ' . var_export($this->actual, true) . ' to be ' . ($this->expected ? 'truthy' : 'falsy');
    }

    public function getNegativeFailureMessage() {
        return 'expected ' . var_export($this->actual, true) . ' to be not ' . ($this->expected ? 'truthy' : 'falsy');
    }
}