<?php
namespace PhpJasmine;

interface Matcher {
    public function __construct($expected);

    public function matches($actual);

    public function getFailureMessage();

    public function getNegativeFailureMessage();
}