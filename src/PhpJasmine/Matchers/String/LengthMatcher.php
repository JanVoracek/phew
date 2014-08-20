<?php
namespace PhpJasmine\Matchers\String;

use PhpJasmine\Matchers\Matcher;

class LengthMatcher implements Matcher {
    /**
     * @var string
     */
    private $expectedLength;
    /**
     * @var string
     */
    private $actualString;

    /**
     * @param mixed $expectedLength There is default null value for those matchers that do not require explicit expectation.
     */
    public function __construct($expectedLength = null) {
        $this->expectedLength = $expectedLength;
    }

    public function matches($actualString) {
        $this->actualString = $actualString;
        $actualLength = mb_strlen($actualString, mb_detect_encoding($actualString));
        return $actualLength === $this->expectedLength;

    }

    /**
     * Returns failure message for positive expectation
     *
     * @return string
     */
    public function getFailureMessage() {
        return "Expected that " . var_export($this->actualString, true) . " has {$this->expectedLength} " . ($this->expectedLength === 1 ? "character" : "characters");
    }

    /**
     * Returns failure message for negative expectation
     *
     * @return string
     */
    public function getNegativeFailureMessage() {
        return "Expected that " . var_export($this->actualString, true) . " does not have {$this->expectedLength} " . ($this->expectedLength === 1 ? "character" : "characters");
    }
}