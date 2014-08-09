<?php

use PhpJasmine\Matchers\Equality\ToBeMatcher;

class ToBeMatcherTest extends PHPUnit_Framework_TestCase {

    public function test_twoSameStringsShouldMatch() {
        $s1 = "foo";
        $s2 = "foo";
        $matcher = new ToBeMatcher($s1);
        $this->assertTrue($matcher->matches($s2));
    }

    public function test_twoDifferentStringsShouldNotMatch() {
        $s1 = "foo";
        $s2 = "bar";
        $matcher = new ToBeMatcher($s1);
        $this->assertFalse($matcher->matches($s2));
    }

    public function test_twoSameIntegersShouldMatch() {
    $number1 = 1;
    $number2 = 1;
    $matcher = new ToBeMatcher($number1);
    $this->assertTrue($matcher->matches($number2));
}

    public function test_twoDifferentIntegersShouldNotMatch() {
        $number1 = 1;
        $number2 = 2;
        $matcher = new ToBeMatcher($number1);
        $this->assertFalse($matcher->matches($number2));
    }

    public function test_twoSameFloatsShouldMatch() {
        $number1 = 1.23;
        $number2 = 1.23;
        $matcher = new ToBeMatcher($number1);
        $this->assertTrue($matcher->matches($number2));
    }

    public function test_twoDifferentFloatsShouldNotMatch() {
        $number1 = 1.23;
        $number2 = 2.34;
        $matcher = new ToBeMatcher($number1);
        $this->assertFalse($matcher->matches($number2));
    }

    public function test_sameIntegerAndFloatShouldNotMatch() {
        $number1 = 5;
        $number2 = 5.0;
        $matcher = new ToBeMatcher($number1);
        $this->assertFalse($matcher->matches($number2));
    }

    public function test_twoSameObjectsShouldMatch() {
        $object1 = new stdClass();
        $object2 = $object1;
        $matcher = new ToBeMatcher($object1);
        $this->assertTrue($matcher->matches($object2));
    }

    public function test_twoSimilarObjectsShouldNotMatch() {
        $object1 = new stdClass();
        $object2 = new stdClass();
        $matcher = new ToBeMatcher($object1);
        $this->assertFalse($matcher->matches($object2));
    }

    public function test_twoSameArraysShouldMatch() {
        $array1 = array('foo' => 'bar');
        $array2 = array('foo' => 'bar');
        $matcher = new ToBeMatcher($array1);
        $this->assertTrue($matcher->matches($array2));
    }

    public function test_matcherShouldGiveNiceFailureMessage() {
        $matcher = new ToBeMatcher(1);
        $matcher->matches(2);
        $failureMessage = 'expected 1, got 2';
        $this->assertEquals($failureMessage, $matcher->getFailureMessage());
    }

    public function test_matcherShouldGiveNiceNegativeFailureMessage() {
        $matcher = new ToBeMatcher(1);
        $matcher->matches(2);
        $failureMessage = 'expected 2 not to be 1';
        $this->assertEquals($failureMessage, $matcher->getNegativeFailureMessage());
    }
}
