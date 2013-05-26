<?php
namespace PhpJasmine;

require_once __DIR__ . '/Example.php';

class ExampleGroup extends Example {
    /**
     * @var Example[]
     */
    private $examples = [];

    /**
     * @var callable|null
     */
    private $examplePrepareFunction;

    /**
     * @var callable|null
     */
    private $exampleCleanupFunction;

    function __construct($name, ExampleGroup $group = null) {
        parent::__construct($name, $group, null);
    }

    public function run(Reporter $reporter) {
        $prepareFunction = $this->examplePrepareFunction;
        $cleanupFunction = $this->exampleCleanupFunction;

        foreach ($this->examples as $example)
            try {
                if (is_callable($prepareFunction) && !($example instanceof ExampleGroup)) {
                    $prepareFunction();
                }
                $example->run($reporter);
                if (is_callable($cleanupFunction) && !($example instanceof ExampleGroup)) {
                    $cleanupFunction();
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
        $this->examplePrepareFunction = $fn;
    }

    public function callAfterEachExample(callable $fn) {
        $this->exampleCleanupFunction = $fn;
    }
}
