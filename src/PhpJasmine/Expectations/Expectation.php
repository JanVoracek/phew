<?php
namespace PhpJasmine\Expectations;

use PhpJasmine\Matchers\Matcher;

/**
 * @property Expectation not
 *
 * // Equality matchers
 * @method void toBe($actual)
 * @method void toBeNull()
 * @method void toBeTrue()
 * @method void toBeFalse()
 * @method void toEqual($actual)
 * @method void toBeTruthy()
 * @method void toBeFalsy()
 * @method void toBeEmpty()
 *
 * // String matchers
 * @method void toMatch($pattern)
 */
abstract class Expectation
{
    private $actual;

    /**
     * @var Matcher
     */
    protected $matcher;

    protected static $matchers;

    public static function setMatchers(array $matchers)
    {
        self::$matchers = $matchers;
    }

    public static function addMatcher($methodName, $matcher, $defaultValue = null)
    {
        $args = func_get_args();
        array_shift($args);
        self::$matchers[$methodName] = $args;
    }

    public function __construct($actual)
    {
        $this->actual = $actual;
    }

    abstract protected function meetsExpectation($actual);

    abstract protected function getMatcherFailureMessage();

    public function __get($name)
    {
        if ($name === 'not') {
            return $this instanceof PositiveExpectation ?
                new NegativeExpectation($this->actual) : new PositiveExpectation($this->actual);
        }
        throw new \Exception("Undefined property");
    }

    public function __call($name, $arguments)
    {
        if (!isset(self::$matchers[$name]) || !class_exists(self::$matchers[$name][0])) {
            throw new \Exception("Matcher \"$name\" not found");
        }

        if (count($arguments) == 0 && count(self::$matchers[$name]) == 0) {
            throw new \InvalidArgumentException("Argument not found");
        }

        $matcherClass = self::$matchers[$name][0];

        $isExpectationExplicit = count($arguments) > 0 || isset(self::$matchers[$name][1]);
        if ($isExpectationExplicit) {
            $expected = count($arguments) > 0 ? $arguments[0] : self::$matchers[$name][1];
            $this->matcher = new $matcherClass($expected);
        } else {
            $this->matcher = new $matcherClass();
        }

        if (!$this->meetsExpectation($this->actual)) {
            throw new ExpectationException($this->getMatcherFailureMessage());
        }
    }
}
