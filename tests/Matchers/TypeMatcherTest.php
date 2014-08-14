<?php

use PhpJasmine\Matchers\Type\TypeMatcher;

class TypeMatcherTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider typesProvider
     */
    public function test_allTypesShouldBeRecognized($value, $type) {
        $matcher = new TypeMatcher($type);
        $this->assertTrue($matcher->matches($value), "Value " . var_export($value, true) . " is not matched as " . var_export($type, true));
    }

    /**
     * @dataProvider wrongTypesProvider
     */
    public function test_typesShouldNotBeMatchedAsDifferentTypes($value, $type) {
        $matcher = new TypeMatcher($type);
        $this->assertFalse($matcher->matches($value), "Value " . var_export($value, true) . " should not be matched as " . var_export($type, true));
    }

    public function test_matcherShouldGiveNiceFailureMessage()
    {
        $matcher = new TypeMatcher("Foo");
        $matcher->matches(new TypeBar());
        $failureMessage = 'expected variable to be Foo. However it is TypeBar';
        $this->assertEquals($failureMessage, $matcher->getFailureMessage());
    }

    public function _test_matcherShouldGiveNiceNegativeFailureMessage()
    {
        $matcher = new TypeMatcher("TypeFoo");
        $matcher->matches(new TypeBar());
        $failureMessage = 'expected variable not to be TypeFoo';
        $this->assertEquals($failureMessage, $matcher->getNegativeFailureMessage());
    }

    public function typesProvider() {
        return array(
            array(true, 'boolean'),
            array(1, 'integer'),
            array(1, 'int'),
            array(1.1, 'float'),
            array(1.1, 'double'),
            array('foo', 'string'),
            array(array(), 'array'),
            array(new stdClass(), 'object'),
            array(new stdClass(), 'stdClass'),
            array(new stdClass(), '\stdClass'),
            array(null, 'null'),
            array(function () {}, 'object'),
            array(function () {}, 'Closure'),
            array(function () {}, 'callable'),
            array(function () {}, 'function'),
            array(fopen(__FILE__, 'r'), 'resource'),
            array(fopen(__FILE__, 'r'), 'stream'),
            array(new TypeBar, 'object'),
            array(new TypeBar, 'TypeBar'),
            array(new TypeBar, '\TypeBar'),
            array(new TypeBar, 'TypeFoo'),
            array(new TypeBar, '\TypeFoo'),
            array(new TypeBaz, 'TypeBar'),
            array(new TypeBaz, '\TypeBar'),
            array(new TypeBaz, 'TypeFoo'),
            array(new TypeBaz, '\TypeFoo'),
        );
    }

    public function wrongTypesProvider() {
        return array(
            array(1, 'float'),
            array(1, 'double'),
            array(1.1, 'int'),
            array(1.1, 'string'),
            array('foo', 'object'),
            array(array(), 'object'),
            array(new stdClass(), 'resource'),
            array(new stdClass(), 'TypeFoo'),
            array(null, 'object'),
            array(fopen(__FILE__, 'r'), 'object'),
        );
    }
}

interface TypeFoo {}
class TypeBar implements TypeFoo {}
class TypeBaz extends TypeBar {}