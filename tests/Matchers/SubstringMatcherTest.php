<?php
namespace Matchers;

use PhpJasmine\Matchers\String\SubstringMatcher;

class SubstringMatcherTest extends \PHPUnit_Framework_TestCase {

    /** @dataProvider correctSubstringProvider */
    public function test_matcherMatchesCorrectSubstring($substring, $string) {
        $matcher = new SubstringMatcher($substring);
        $this->assertTrue($matcher->matches($string));
    }

    /** @dataProvider wrongSubstringProvider */
    public function test_matcherDontMatchesWrongSubstring($substring, $string) {
        $matcher = new SubstringMatcher($substring);
        $this->assertFalse($matcher->matches($string));
    }

    public function test_matcherGivesNiceFailureMessage() {
        $matcher = new SubstringMatcher("foo");
        $matcher->matches("bar");
        $failureMessage = $matcher->getFailureMessage();
        $this->assertEquals("Expected that 'bar' contains 'foo'", $failureMessage);
    }

    public function test_matcherGivesNiceNegativeFailureMessage() {
        $matcher = new SubstringMatcher("foo");
        $matcher->matches("foobar");
        $failureMessage = $matcher->getNegativeFailureMessage();
        $this->assertEquals("Expected that 'foobar' does not contain 'foo'", $failureMessage);
    }

    public function correctSubstringProvider() {
        return array(
            array("str", "substring"),
            array("_", "foo_bar"),
            array("substring", "substring"),
            array("", "empty substring"),
            array("foo", "foobar"),
            array("bar", "foobar"),
            array("です", "元気ですか？"),
        );
    }

    public function wrongSubstringProvider() {
        return array(
            array("foo", "string"),
            array("substring", "string"),
            array("s", ""),
            array("元気で", "元ですか？"),
        );
    }
} 