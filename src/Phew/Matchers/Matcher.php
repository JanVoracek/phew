<?php
namespace Phew\Matchers;

interface Matcher
{
    /**
     * @param mixed $expected There is default null value for those matchers that do not require explicit expectation.
     */
    public function __construct($expected = null);

    /**
     * Returns true if matcher matches $actual
     *
     * @param $actual
     * @return bool
     */
    public function matches($actual);

    /**
     * Returns failure message for positive expectation
     *
     * @return string
     */
    public function getFailureMessage();

    /**
     * Returns failure message for negative expectation
     *
     * @return string
     */
    public function getNegativeFailureMessage();
}
