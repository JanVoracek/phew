<?php

use Phew\Expectations\NegativeExpectation;
use Phew\Expectations\PositiveExpectation;
use Phew\Matchers\Matcher;


class ExpectationTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Matcher "toMatch" not found
     */
    public function test_unknownMatcherThrowsException()
    {
        $expectation = new PositiveExpectation('');
        $expectation->toMatch('anything');
    }

    public function test_matchersCanBeDynamicallyChanged()
    {
        $expectation = new PositiveExpectation('');
        $expectation->setMatchers(array('toMatch' => array('AlwaysTrueMatcher')));
        $expectation->toMatch('anything');
    }

    /**
     * @expectedException \Phew\Expectations\ExpectationException
     * @expectedExceptionMessage It is matching
     */
    public function test_positiveExpectationCanBeTurnedToNegativeExpectation()
    {
        $expectation = new PositiveExpectation('');
        $expectation->setMatchers(array('toMatch' => array('AlwaysTrueMatcher')));
        $expectation->not->toMatch('anything');
    }

    public function test_negativeExpectationCanBeTurnedToPositiveExpectation()
    {
        $expectation = new NegativeExpectation('');
        $expectation->setMatchers(array('toMatch' => array('AlwaysTrueMatcher')));
        $expectation->not->toMatch('anything');
    }
}


class AlwaysTrueMatcher implements Matcher
{

    public function __construct($expected = null)
    {
    }

    public function matches($actual)
    {
        return true;
    }

    public function getFailureMessage()
    {
        return 'It is not matching';
    }

    public function getNegativeFailureMessage()
    {
        return 'It is matching';
    }
}