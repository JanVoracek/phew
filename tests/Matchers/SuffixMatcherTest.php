<?php
namespace Matchers;

use Phew\Matchers\String\SuffixMatcher;

class SuffixMatcherTest extends \PHPUnit_Framework_TestCase {

    /** @dataProvider correctSuffixProvider */
    public function test_matcherMatchesCorrectSuffix($suffix, $string) {
        $matcher = new SuffixMatcher($suffix);
        $this->assertTrue($matcher->matches($string));
    }

    /** @dataProvider wrongSuffixProvider */
    public function test_matcherDontMatchesWrongSuffix($suffix, $string) {
        $matcher = new SuffixMatcher($suffix);
        $this->assertFalse($matcher->matches($string));
    }

    public function test_matcherGivesNiceFailureMessage() {
        $matcher = new SuffixMatcher("foo");
        $matcher->matches("bar");
        $failureMessage = $matcher->getFailureMessage();
        $this->assertEquals("Expected that 'bar' ends with 'foo'", $failureMessage);
    }

    public function test_matcherGivesNiceNegativeFailureMessage() {
        $matcher = new SuffixMatcher("bar");
        $matcher->matches("foobar");
        $failureMessage = $matcher->getNegativeFailureMessage();
        $this->assertEquals("Expected that 'foobar' does not end with 'bar'", $failureMessage);
    }

    public function correctSuffixProvider() {
        return array(
            array("fix", "suffix"),
            array("_", "foo_"),
            array("suffix", "suffix"),
            array("", "empty suffix"),
            array("か？", "元気ですか？"),
        );
    }

    public function wrongSuffixProvider() {
        return array(
            array("suf", "suffix"),
            array("_", "foo_bar"),
            array("suffix", "uffix"),
            array("p", ""),
            array("元気で", "元ですか？"),
        );
    }
} 