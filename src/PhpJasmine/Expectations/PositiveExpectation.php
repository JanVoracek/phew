<?php
namespace PhpJasmine\Expectations;

class PositiveExpectation extends Expectation
{

    protected function meetsExpectation($actual)
    {
        return $this->matcher->matches($actual);
    }

    protected function getMatcherFailureMessage()
    {
        return $this->matcher->getFailureMessage();
    }
}
