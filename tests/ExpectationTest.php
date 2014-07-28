<?php
require_once __DIR__ . '/../src/Expectation.php';
require_once __DIR__ . '/../src/Matcher.php';

use PhpJasmine\PositiveExpectation,
    PhpJasmine\NegativeExpectation,
    PhpJasmine\Matcher;


class ExpectationTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Matcher "toMatch" not found
     */
    public function test_unknownMatcherThrowsExeption() {
        $expectation = new PositiveExpectation('');
        $expectation->toMatch('anything');
    }

    public function test_matchersCanBeDynamicallyChanged() {
        $expectation = new PositiveExpectation('');
        $expectation->setMatchers(array('toMatch' => array('AlwaysTrueMatcher')));
        $expectation->toMatch('anything');
    }

    /**
     * @expectedException \PhpJasmine\ExpectationException
     * @expectedExceptionMessage It is matching
     */
    public function test_positiveExpectationCanBeTurnedToNegativeExpectation(){
        $expectation = new PositiveExpectation('');
        $expectation->setMatchers(array('toMatch' => array('AlwaysTrueMatcher')));
        $expectation->not->toMatch('anything');
    }

    public function test_negativeExpectationCanBeTurnedToPositiveExpectation(){
        $expectation = new NegativeExpectation('');
        $expectation->setMatchers(array('toMatch' => array('AlwaysTrueMatcher')));
        $expectation->not->toMatch('anything');
    }
}


class AlwaysTrueMatcher implements Matcher {

    public function __construct($expected = null) {
    }

    public function matches($actual) {
        return true;
    }

    public function getFailureMessage() {
        return 'It is not matching';
    }

    public function getNegativeFailureMessage() {
        return 'It is matching';
    }
}