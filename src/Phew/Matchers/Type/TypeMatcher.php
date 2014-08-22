<?php
namespace Phew\Matchers\Type;

use Phew\Matchers\Matcher;

class TypeMatcher implements Matcher {

    private $expectedType;
    private $actualType;
    private $variableName;

    public function __construct($expectedType = null) {
        $this->expectedType = $expectedType;
    }

    public function matches($value) {
        $this->variableName = $this->tryToGetVariableName();
        $expectedTypeLowered = ltrim(strtolower($this->expectedType), "\\");
        $this->actualType = strtolower(gettype($value));

        if ($expectedTypeLowered === $this->actualType) {
            return true;
        }

        if (is_int($value)) {
            return $expectedTypeLowered === "int";
        }

        if (is_float($value)) {
            return $expectedTypeLowered === "float";
        }

        if(is_callable($value)) {
            $this->actualType = get_class($value);
            return $expectedTypeLowered === "callable" || $expectedTypeLowered === "function"
                || $expectedTypeLowered === "closure";
        }

        if (is_object($value)) {
            $this->actualType = get_class($value);
            return is_a($value, $expectedTypeLowered);
        }

        if(is_null($value)) {
            return $expectedTypeLowered === "null";
        }

        if(is_resource($value)) {
            $this->actualType = get_resource_type($value);
            return $expectedTypeLowered === strtolower(get_resource_type($value));
        }

        return false;
    }

    public function getFailureMessage() {
        $varName = $this->variableName ? "\"{$this->variableName}\"" : "variable";
        return "expected {$varName} to be " . $this->expectedType . '. However it is ' . $this->actualType;
    }

    public function getNegativeFailureMessage() {
        $varName = $this->variableName ? "\"{$this->variableName}\"" : "variable";
        return "expected {$varName} not to be " . $this->expectedType;
    }

    private function tryToGetVariableName() {
        $trace = debug_backtrace();
        $file = file($trace[3]['file']);
        $line = $file[$trace[3]['line'] - 1];

        $matches = array();

        preg_match("/.*expect\((.*)\)->.*/i", $line, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        }

        return "";
    }
}