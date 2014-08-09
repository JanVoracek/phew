<?php
namespace PhpJasmine;

class ExampleGroup extends Example {
    /**
     * @var Example[]
     */
    private $examples = array();

    /**
     * @var callable[]
     */
    private $examplePrepareFunctions = array();

    /**
     * @var callable[]
     */
    private $exampleCleanupFunctions = array();

    function __construct($name, ExampleGroup $group = null) {
        parent::__construct($name, $group, null);
    }

    public function run(Reporter $reporter) {
        $prepareFunctions = $this->examplePrepareFunctions;
        $cleanupFunctions = $this->exampleCleanupFunctions;

        foreach ($this->examples as $example)
            try {
                if (!($example instanceof ExampleGroup)) {
                    $this->callAllFunctions($prepareFunctions);
                }
                $example->run($reporter);
                if (!($example instanceof ExampleGroup)) {
                    $this->callAllFunctions($cleanupFunctions);
                }
            } catch (\Exception $ex) {
                $reporter->reportFailedExample($this, $ex);
            }
    }

    public function add(Example $example) {
        $this->examples[] = $example;
        if($example instanceof ExampleGroup) {
            foreach($this->examplePrepareFunctions as $prepareFunction)
                $example->callBeforeEachExample($prepareFunction);
            foreach($this->exampleCleanupFunctions as $cleanupFunction)
                $example->callBeforeEachExample($cleanupFunction);
        }
    }

    public static function createRootExampleGroup() {
        return new ExampleGroup("", null);
    }

    /**
     * @param callable $fn
     */
    public function callBeforeEachExample($fn) {
        $this->examplePrepareFunctions[] = $fn;
        foreach($this->examples as $example)
            if($example instanceof ExampleGroup)
                $example->callBeforeEachExample($fn);

    }

    /**
     * @param callable $fn
     */
    public function callAfterEachExample($fn) {
        $this->exampleCleanupFunctions[] = $fn;
        foreach($this->examples as $example)
            if($example instanceof ExampleGroup)
                $example->callAfterEachExample($fn);
    }

    private function callAllFunctions($functions) {
        array_walk($functions, function ($function) {
            $function();
        });
    }
}
