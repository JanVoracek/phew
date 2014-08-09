<?php
namespace PhpJasmine\Matchers\String;

use PhpJasmine\Matchers\Matcher;

class RegularExpressionMatcher implements Matcher {

    private $regularExpression;
    private $compareTarget;

    public function __construct($regularExpression = null) {
        $this->regularExpression = $regularExpression;
    }

    public function matches($compareTarget) {
        $this->compareTarget = $compareTarget;
        return preg_match($this->regularExpression, $compareTarget) !== 0;
    }

    public function getFailureMessage() {
        return 'expected ' . var_export($this->compareTarget, true) . ' to match ' . $this->regularExpression;
    }

    public function getNegativeFailureMessage() {
        return 'expected ' . var_export($this->compareTarget, true) . ' not to match ' . $this->regularExpression;
    }
}