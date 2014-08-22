<?php
namespace Matchers;

use Phew\Matchers\String\LengthMatcher;

class LengthMatcherTest extends \PHPUnit_Framework_TestCase {

    /** @dataProvider correctLengthProvider */
    public function test_matcherMatchesCorrectLength($length, $string) {
        $matcher = new LengthMatcher($length);
        $this->assertTrue($matcher->matches($string));
    }

    /** @dataProvider wrongLengthProvider */
    public function test_matcherDontMatchesWrongLength($length, $string) {
        $matcher = new LengthMatcher($length);
        $this->assertFalse($matcher->matches($string));
    }

    public function test_matcherGivesNiceFailureMessage() {
        $matcher = new LengthMatcher(4);
        $matcher->matches("foo");
        $failureMessage = $matcher->getFailureMessage();
        $this->assertEquals("Expected that 'foo' has 4 characters", $failureMessage);
    }

    public function test_matcherGivesNiceNegativeFailureMessage() {
        $matcher = new LengthMatcher(3);
        $matcher->matches("foo");
        $failureMessage = $matcher->getNegativeFailureMessage();
        $this->assertEquals("Expected that 'foo' does not have 3 characters", $failureMessage);
    }

    public function correctLengthProvider() {
        return array(
            array(3, "foo"),
            array(0, ""),
            array(6, "元気ですか？"),
        );
    }

    public function wrongLengthProvider() {
        return array(
            array(2, "foo"),
            array(3, " foo"),
            array(1, ""),
            array(10, "元ですか？"),
        );
    }
} 