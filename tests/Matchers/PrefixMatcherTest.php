<?php
namespace Matchers;

use PhpJasmine\Matchers\String\PrefixMatcher;

class PrefixMatcherTest extends \PHPUnit_Framework_TestCase {

    /** @dataProvider correctPrefixProvider */
    public function test_matcherMatchesCorrectPrefix($prefix, $string) {
        $matcher = new PrefixMatcher($prefix);
        $this->assertTrue($matcher->matches($string));
    }

    /** @dataProvider wrongPrefixProvider */
    public function test_matcherDontMatchesWrongPrefix($prefix, $string) {
        $matcher = new PrefixMatcher($prefix);
        $this->assertFalse($matcher->matches($string));
    }

    public function test_matcherGivesNiceFailureMessage() {
        $matcher = new PrefixMatcher("foo");
        $matcher->matches("bar");
        $failureMessage = $matcher->getFailureMessage();
        $this->assertEquals("Expected that 'bar' starts with 'foo'", $failureMessage);
    }

    public function test_matcherGivesNiceNegativeFailureMessage() {
        $matcher = new PrefixMatcher("foo");
        $matcher->matches("foobar");
        $failureMessage = $matcher->getNegativeFailureMessage();
        $this->assertEquals("Expected that 'foobar' does not start with 'foo'", $failureMessage);
    }

    public function correctPrefixProvider() {
        return array(
            array("pre", "prefix"),
            array("_", "_foo"),
            array("prefix", "prefix"),
            array("", "empty prefix"),
            array("元気で", "元気ですか？"),
        );
    }

    public function wrongPrefixProvider() {
        return array(
            array("pre", "postfix"),
            array("_", "foo_bar"),
            array("prefix", "prefi"),
            array("p", ""),
            array("元気で", "元ですか？"),
        );
    }
} 