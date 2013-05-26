<?php
namespace PhpJasmine;

class Example {

    private $name;
    private $group;
    private $fn;

    function __construct($name, ExampleGroup $group = null, callable $fn = null) {
        $this->name = $name;
        $this->group = $group;
        $this->fn = $fn;
    }

    public function run(Reporter $reporter) {
        $fn = $this->fn;
        if (is_callable($fn))
            try {
                $fn();
            } catch (\Exception $ex) {
                $reporter->reportFailedExample($this, $ex);
            }
    }

    public function getName() {
        return $this->name;
    }
}
