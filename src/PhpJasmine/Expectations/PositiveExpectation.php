<?php
namespace PhpJasmine\Expectations;

use PhpJasmine\Expectations\Expectation;

class PositiveExpectation extends Expectation {

    protected function meetsExpectation($actual) {
        return $this->matcher->matches($actual);
    }

    protected function getMatcherFailureMessage() {
        return $this->matcher->getFailureMessage();
    }
}