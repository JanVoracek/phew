<?php
namespace PhpJasmine\Expectations;

class NegativeExpectation extends Expectation
{

    protected function meetsExpectation($actual)
    {
        return !$this->matcher->matches($actual);
    }

    protected function getMatcherFailureMessage()
    {
        return $this->matcher->getNegativeFailureMessage();
    }
}