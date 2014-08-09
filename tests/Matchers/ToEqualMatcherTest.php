<?php
use PhpJasmine\Matchers\Equality\ToEqualMatcher;

class ToEqualMatcherTest extends PHPUnit_Framework_TestCase
{

    public function test_twoSameStringsShouldMatch()
    {
        $s1 = "foo";
        $s2 = "foo";
        $matcher = new ToEqualMatcher($s1);
        $this->assertTrue($matcher->matches($s2));
    }

    public function test_twoDifferentStringsShouldNotMatch()
    {
        $s1 = "foo";
        $s2 = "bar";
        $matcher = new ToEqualMatcher($s1);
        $this->assertFalse($matcher->matches($s2));
    }

    public function test_twoSameIntegersShouldMatch()
    {
        $number1 = 1;
        $number2 = 1;
        $matcher = new ToEqualMatcher($number1);
        $this->assertTrue($matcher->matches($number2));
    }

    public function test_twoDifferentIntegersShouldNotMatch()
    {
        $number1 = 1;
        $number2 = 2;
        $matcher = new ToEqualMatcher($number1);
        $this->assertFalse($matcher->matches($number2));
    }

    public function test_twoSameFloatsShouldMatch()
    {
        $number1 = 1.23;
        $number2 = 1.23;
        $matcher = new ToEqualMatcher($number1);
        $this->assertTrue($matcher->matches($number2));
    }

    public function test_twoDifferentFloatsShouldNotMatch()
    {
        $number1 = 1.23;
        $number2 = 2.34;
        $matcher = new ToEqualMatcher($number1);
        $this->assertFalse($matcher->matches($number2));
    }

    public function test_sameIntegerAndFloatShouldMatchWithTolerance()
    {
        $number1 = 5;
        $number2 = 5.0;
        $matcher = new ToEqualMatcher($number1);
        $this->assertTrue($matcher->matches($number2));
    }

    public function test_twoVeryCloseFloatsShouldMatchWithTolerance()
    {
        $number1 = 35 - 34.999; // 0.000999999999998
        $number2 = 0.001;
        $matcher = new ToEqualMatcher($number1);
        $this->assertTrue($matcher->matches($number2));
    }

    public function test_twoSameObjectsShouldMatch()
    {
        $object1 = new stdClass();
        $object2 = $object1;
        $matcher = new ToEqualMatcher($object1);
        $this->assertTrue($matcher->matches($object2));
    }

    public function test_twoSimilarObjectsShouldMatch()
    {
        $object1 = new stdClass();
        $object2 = new stdClass();
        $matcher = new ToEqualMatcher($object1);
        $this->assertTrue($matcher->matches($object2));
    }

    public function test_twoSameArraysShouldMatch()
    {
        $array1 = array('foo' => 'bar');
        $array2 = array('foo' => 'bar');
        $matcher = new ToEqualMatcher($array1);
        $this->assertTrue($matcher->matches($array2));
    }

    public function test_matcherShouldGiveNiceFailureMessage()
    {
        $matcher = new ToEqualMatcher(1);
        $matcher->matches(2);
        $failureMessage = 'expected 1, got 2';
        $this->assertEquals($failureMessage, $matcher->getFailureMessage());
    }

    public function test_matcherShouldGiveNiceNegativeFailureMessage()
    {
        $matcher = new ToEqualMatcher(1);
        $matcher->matches(2);
        $failureMessage = 'expected 2 not to equal 1';
        $this->assertEquals($failureMessage, $matcher->getNegativeFailureMessage());
    }
}
