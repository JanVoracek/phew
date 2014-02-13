<?php
namespace PhpJasmine;

require_once __DIR__ . '/Example.php';

class ExampleGroup extends Example {
    /**
     * @var Example[]
     */
    private $examples = [];

    /**
     * @var callable[]
     */
    private $examplePrepareFunctions = [];

    /**
     * @var callable[]
     */
    private $exampleCleanupFunctions = [];

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
    }

    public static function createRootExampleGroup() {
        return new ExampleGroup("", null);
    }

    public function callBeforeEachExample(callable $fn) {
        $this->examplePrepareFunctions[] = $fn;

    }

    public function callAfterEachExample(callable $fn) {
        $this->exampleCleanupFunctions[] = $fn;
    }

    private function callAllFunctions($functions) {
        array_walk($functions, function ($function) {
            $function();
        });
    }
}
