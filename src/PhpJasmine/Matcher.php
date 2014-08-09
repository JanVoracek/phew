<?php
namespace PhpJasmine;

interface Matcher {
    /**
     * @param mixed $expected There is default null value for those matchers that do not require explicit expectation.
     */
    public function __construct($expected = null);

    public function matches($actual);

    public function getFailureMessage();

    public function getNegativeFailureMessage();
}