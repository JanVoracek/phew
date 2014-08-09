<?php
namespace PhpJasmine;

class Example
{
    private $name;
    private $fn;

    public function __construct($name, $fn = null)
    {
        $this->name = $name;
        $this->fn = $fn;
    }

    public function run(Reporter $reporter)
    {
        $fn = $this->fn;
        if (is_callable($fn)) {
            try {
                $fn();
                $reporter->reportSucceededExample($this);
            } catch (\Exception $ex) {
                $reporter->reportFailedExample($this, $ex);
            }
        }
    }

    public function getName()
    {
        return $this->name;
    }
}
