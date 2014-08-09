<?php
use \PhpJasmine\Matchers\Equality\LooseBooleanMatcher;

class TruthyBooleanMatcherTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var LooseBooleanMatcher
     */
    private $matcher;

    protected function setUp()
    {
        $this->matcher = new LooseBooleanMatcher(true);
    }

    public function test_truthyMatcherShouldMatchTrue()
    {
        $this->assertTrue($this->matcher->matches(true));
    }

    public function test_truthyMatcherShouldMatchNonemptyString()
    {
        $this->assertTrue($this->matcher->matches('foo'));
    }

    public function test_truthyMatcherShouldMatchNonzeroNumber()
    {
        $this->assertTrue($this->matcher->matches(5));
    }

    public function test_truthyMatcherShouldMatchNonEmptyArray()
    {
        $this->assertTrue($this->matcher->matches(array('')));
    }

    public function test_truthyMatcherShouldMatchObject()
    {
        $this->assertTrue($this->matcher->matches(new stdClass()));
    }

    public function test_truthyMatcherShouldNotMatchFalse()
    {
        $this->assertFalse($this->matcher->matches(false));
    }

    public function test_truthyMatcherShouldNotMatchEmptyString()
    {
        $this->assertFalse($this->matcher->matches(''));
    }

    public function test_truthyMatcherShouldNotMatchZero()
    {
        $this->assertFalse($this->matcher->matches(0));
    }

    public function test_truthyMatcherShouldNotMatchEmptyArray()
    {
        $this->assertFalse($this->matcher->matches(array()));
    }

    public function test_truthyMatcherShouldNotMatchNull()
    {
        $this->assertFalse($this->matcher->matches(null));
    }

    public function test_falsyMatcherShouldMatchTrue()
    {
        $this->assertTrue($this->matcher->matches(true));
    }

    public function test_itGivesBackNiceFailureMessage()
    {
        $this->matcher->matches('foo');
        $expectedFailureMessage = "expected 'foo' to be truthy";
        $this->assertEquals($expectedFailureMessage, $this->matcher->getFailureMessage());
    }

    public function test_itGivesBackNiceNegativeFailureMessage()
    {
        $this->matcher->matches('foo');
        $expectedFailureMessage = "expected 'foo' to be not truthy";
        $this->assertEquals($expectedFailureMessage, $this->matcher->getNegativeFailureMessage());
    }
}