<?php
require_once __DIR__ . '/../src/PhpJasmine/Expectation.php';
require_once __DIR__ . '/../src/PhpJasmine/Matcher.php';

use PhpJasmine\PositiveExpectation,
    PhpJasmine\NegativeExpectation,
    PhpJasmine\Matcher;


class ExpectationTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Matcher not found
     */
    public function test_unknownMatcherThrowsExeption() {
        $expectation = new PositiveExpectation('');
        $expectation->toMatch('anything');
    }

    public function test_matchersCanBeDynamicallyChanged() {
        $expectation = new PositiveExpectation('');
        $expectation->setMatchers(array('toMatch' => ['AlwaysTrueMatcher']));
        $expectation->toMatch('anything');
    }

    /**
     * @expectedException \PhpJasmine\ExpectationException
     * @expectedExceptionMessage It is matching
     */
    public function test_positiveExpectationCanBeTurnedToNegativeExpectation(){
        $expectation = new PositiveExpectation('');
        $expectation->setMatchers(array('toMatch' => ['AlwaysTrueMatcher']));
        $expectation->not->toMatch('anything');
    }

    public function test_negativeExpectationCanBeTurnedToPositiveExpectation(){
        $expectation = new NegativeExpectation('');
        $expectation->setMatchers(array('toMatch' => ['AlwaysTrueMatcher']));
        $expectation->not->toMatch('anything');
    }
}


class AlwaysTrueMatcher implements Matcher {

    public function __construct($expected) {
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