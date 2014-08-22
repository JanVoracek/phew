<?php

use Phew\Matchers\Equality\LooseBooleanMatcher;

class FalsyBooleanMatcherTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var LooseBooleanMatcher
     */
    private $matcher;

    protected function setUp()
    {
        $this->matcher = new LooseBooleanMatcher(false);
    }

    public function test_falsyMatcherShouldMatchEmptyString()
    {
        $this->assertTrue($this->matcher->matches(''));
    }

    public function test_falsyMatcherShouldMatchZero()
    {
        $this->assertTrue($this->matcher->matches(0));
    }

    public function test_falsyMatcherShouldMatchEmptyArray()
    {
        $this->assertTrue($this->matcher->matches(array()));
    }

    public function test_falsyMatcherShouldMatchNull()
    {
        $this->assertTrue($this->matcher->matches(null));
    }

    public function test_falsyMatcherShouldNotMatchTrue()
    {
        $this->assertFalse($this->matcher->matches(true));
    }

    public function test_falsyMatcherShouldNotMatchNonemptyString()
    {
        $this->assertFalse($this->matcher->matches('foo'));
    }

    public function test_falsyMatcherShouldNotMatchNonzeroNumber()
    {
        $this->assertFalse($this->matcher->matches(5));
    }

    public function test_falsyMatcherShouldNotMatchNonemptyArray()
    {
        $this->assertFalse($this->matcher->matches(array('')));
    }

    public function test_falsyMatcherShouldNotMatchObject()
    {
        $this->assertFalse($this->matcher->matches(new stdClass()));
    }

    public function test_itGivesBackNiceFailureMessage()
    {
        $this->matcher->matches('foo');
        $expectedFailureMessage = "expected 'foo' to be falsy";
        $this->assertEquals($expectedFailureMessage, $this->matcher->getFailureMessage());
    }

    public function test_itGivesBackNiceNegativeFailureMessage()
    {
        $this->matcher->matches('foo');
        $expectedFailureMessage = "expected 'foo' to be not falsy";
        $this->assertEquals($expectedFailureMessage, $this->matcher->getNegativeFailureMessage());
    }

}