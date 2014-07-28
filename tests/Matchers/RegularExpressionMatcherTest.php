<?php
use PhpJasmine\Matchers\RegularExpressionMatcher;

include_once __DIR__ . '/../../src/Matcher.php';
include_once __DIR__ . '/../../src/Matchers/RegularExpressionMatcher.php';



class RegularExpressionMatcherTest extends PHPUnit_Framework_TestCase {

    public function test_emptyRegularExpressionMatchesEverything() {
        $string = "foo";
        $regularExpression = "//";
        $matcher = new RegularExpressionMatcher($regularExpression);
        $this->assertTrue($matcher->matches($string));
    }

    public function test_stringCorrespondingWithExpressionMatches() {
        $string = "foo";
        $regularExpression = "/^Fo{2}$/i";
        $matcher = new RegularExpressionMatcher($regularExpression);
        $this->assertTrue($matcher->matches($string));
    }

    public function test_stringNotCorrespondingWithExpressionNotMatches() {
        $string = "foo";
        $regularExpression = "/^b/";
        $matcher = new RegularExpressionMatcher($regularExpression);
        $this->assertFalse($matcher->matches($string));
    }

    public function test_matcherShouldGiveNiceFailureMessage() {
        $regexp = "/foo/";
        $string = "bar";
        $matcher = new RegularExpressionMatcher($regexp);
        $matcher->matches($string);
        $failureMessage = "expected '$string' to match $regexp";
        $this->assertEquals($failureMessage, $matcher->getFailureMessage());
    }

    public function test_matcherShouldGiveNiceNegativeFailureMessage() {
        $regexp = "/foo/";
        $string = "foo";
        $matcher = new RegularExpressionMatcher($regexp);
        $matcher->matches($string);
        $failureMessage = "expected '$string' not to match $regexp";
        $this->assertEquals($failureMessage, $matcher->getNegativeFailureMessage());
    }
}
