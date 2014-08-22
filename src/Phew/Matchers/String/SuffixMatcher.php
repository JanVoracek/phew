<?php
namespace Phew\Matchers\String;

use Phew\Matchers\Matcher;

class SuffixMatcher implements Matcher {
    /**
     * @var string
     */
    private $expectedSuffix;
    /**
     * @var string
     */
    private $actual;

    /**
     * @param mixed $expectedSuffix There is default null value for those matchers that do not require explicit expectation.
     */
    public function __construct($expectedSuffix = null) {
        $this->expectedSuffix = $expectedSuffix;
    }

    public function matches($actualString) {
        $this->actual = $actualString;
        $suffixLength = strlen($this->expectedSuffix);
        $actualSuffix = substr($actualString, -$suffixLength, $suffixLength);
        return $actualSuffix === $this->expectedSuffix;

    }

    /**
     * Returns failure message for positive expectation
     *
     * @return string
     */
    public function getFailureMessage() {
        return "Expected that " . var_export($this->actual, true) . " ends with " . var_export($this->expectedSuffix, true);
    }

    /**
     * Returns failure message for negative expectation
     *
     * @return string
     */
    public function getNegativeFailureMessage() {
        return "Expected that " . var_export($this->actual, true) . " does not end with " . var_export($this->expectedSuffix, true);
    }
}