<?php
namespace Phew\Matchers\String;

use Phew\Matchers\Matcher;

class PrefixMatcher implements Matcher {
    /**
     * @var string
     */
    private $expectedPrefix;
    /**
     * @var string
     */
    private $actual;

    /**
     * @param mixed $expectedPrefix There is default null value for those matchers that do not require explicit expectation.
     */
    public function __construct($expectedPrefix = null) {
        $this->expectedPrefix = $expectedPrefix;
    }

    public function matches($actualString) {
        $this->actual = $actualString;
        $prefixLength = strlen($this->expectedPrefix);
        $actualPrefix = substr($actualString, 0, $prefixLength);
        return $actualPrefix === $this->expectedPrefix;

    }

    /**
     * Returns failure message for positive expectation
     *
     * @return string
     */
    public function getFailureMessage() {
        return "Expected that " . var_export($this->actual, true) . " starts with " . var_export($this->expectedPrefix, true);
    }

    /**
     * Returns failure message for negative expectation
     *
     * @return string
     */
    public function getNegativeFailureMessage() {
        return "Expected that " . var_export($this->actual, true) . " does not start with " . var_export($this->expectedPrefix, true);
    }
}