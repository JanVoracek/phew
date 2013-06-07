<?php
namespace PhpJasmine;
require_once __DIR__ . '/Matcher.php';
require_once __DIR__ . '/Matchers/ToBeMatcher.php';
require_once __DIR__ . '/Matchers/ToEqualMatcher.php';

/**
 * @property Expectation not
 * @method void toBe($actual)
 * @method void toEqual($actual)
 */
abstract class Expectation {

    private $actual;

    /**
     * @var Matcher
     */
    protected $matcher;

    protected static $matchers;

    public static function setMatchers(array $matchers) {
        self::$matchers = $matchers;
    }


    function __construct($actual) {
        $this->actual = $actual;
    }

    protected abstract function meetsExpectation($actual);

    protected abstract function getMatcherFailureMessage();

    function __get($name) {
        if ($name === 'not')
            return $this instanceof PositiveExpectation ?
                new NegativeExpectation($this->actual) : new PositiveExpectation($this->actual);
        throw new \Exception("Undefined property");
    }

    function __call($name, $arguments) {
        if (!isset(self::$matchers[$name]) || !class_exists(self::$matchers[$name][0]))
            throw new \Exception("Matcher not found");

        if (count($arguments) == 0 && count(self::$matchers[$name]) == 0)
            throw new \InvalidArgumentException("Argument not found");

        $matcherClass = self::$matchers[$name][0];
        $expected = count($arguments) > 0 ? $arguments[0] : self::$matchers[$name][1];
        $this->matcher = new $matcherClass($expected);
        if (!$this->meetsExpectation($this->actual)) {
            throw new ExpectationException($this->getMatcherFailureMessage());
        }
    }
}

class PositiveExpectation extends Expectation {

    protected function meetsExpectation($actual) {
        return $this->matcher->matches($actual);
    }

    protected function getMatcherFailureMessage() {
        return $this->matcher->getFailureMessage();
    }
}

class NegativeExpectation extends Expectation {

    protected function meetsExpectation($actual) {
        return !$this->matcher->matches($actual);
    }

    protected function getMatcherFailureMessage() {
        return $this->matcher->getNegativeFailureMessage();
    }
}

class ExpectationException extends \Exception {

}