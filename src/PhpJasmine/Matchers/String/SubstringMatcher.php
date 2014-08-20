<?php
namespace PhpJasmine\Matchers\String;

use PhpJasmine\Matchers\Matcher;

class SubstringMatcher implements Matcher {
    /**
     * @var string
     */
    private $expectedSubstring;
    /**
     * @var string
     */
    private $actual;

    /**
     * @param mixed $expectedSubstring There is default null value for those matchers that do not require explicit expectation.
     */
    public function __construct($expectedSubstring = null) {
        $this->expectedSubstring = $expectedSubstring;
    }

    public function matches($actualString) {
        $this->actual = $actualString;
        if($this->expectedSubstring === "") return true;
        return strpos($actualString, $this->expectedSubstring) !== false;

    }

    /**
     * Returns failure message for positive expectation
     *
     * @return string
     */
    public function getFailureMessage() {
        return "Expected that " . var_export($this->actual, true) . " contains " . var_export($this->expectedSubstring, true);
    }

    /**
     * Returns failure message for negative expectation
     *
     * @return string
     */
    public function getNegativeFailureMessage() {
        return "Expected that " . var_export($this->actual, true) . " does not contain " . var_export($this->expectedSubstring, true);
    }
}