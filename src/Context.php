<?php
namespace PhpJasmine;

require_once __DIR__ . '/ExampleGroup.php';
require_once __DIR__ . '/Reporter.php';

class Context {

    private $rootExampleGroup;
    private $currentExampleGroup;

    public function __construct() {
        $this->rootExampleGroup = ExampleGroup::createRootExampleGroup();
        $this->currentExampleGroup = $this->rootExampleGroup;
    }

    /**
     * @param string $title
     * @param callable $fn
     * @throws FailException
     */
    public function describe($title, $fn = null) {
        $parentGroup = $this->currentExampleGroup;
        $this->currentExampleGroup = new ExampleGroup($title, $parentGroup);
        $parentGroup->add($this->currentExampleGroup);

        if (is_callable($fn)) {
            try {
                $fn();
            } catch (\Exception $ex) {
                $this->fail("Unexpected exception");
            }

            $this->currentExampleGroup = $parentGroup;
        }
    }

    /**
     * @param string $title
     * @param callable $fn
     */
    public function xdescribe($title, $fn = null) {
    }

    /**
     * @param string $title
     * @param callable $fn
     */
    public function it($title, $fn = null) {
        $fullName = $this->getFullName();
        $example = new Example($fullName, $fn);
        $this->currentExampleGroup->add($example);
    }

    /**
     * @param string $title
     * @param callable $fn
     */
    public function xit($title, $fn = null) {
    }

    /**
     * @param callable $fn
     */
    public function beforeEach($fn) {
        $this->currentExampleGroup->callBeforeEachExample($fn);
    }

    /**
     * @param callable $fn
     */
    public function afterEach($fn) {
        $this->currentExampleGroup->callAfterEachExample($fn);
    }

    public function fail($title) {
        throw new FailException($title);
    }

    public function runExamples(Reporter $reporter = null) {
        if ($reporter === null) $reporter = new Reporter();
        $this->rootExampleGroup->run($reporter);
    }

    private function getFullName() {
        $relevantMethods = array('it', 'describe');
        try {
            throw new \Exception("");
        } catch (\Exception $ex) {
            $exampleCallStack = array();

            foreach ($ex->getTrace() as $call) {
                if (isset($call['class']) && $call['class'] == __CLASS__ && in_array($call['function'], $relevantMethods))
                    $exampleCallStack[] = $call;
            }

            $exampleCallList = array_reverse($exampleCallStack);
            $fullName = "";
            foreach ($exampleCallList as $call) {
                $fullName .= $call['args'][0] . ' ';
            }

            $fullName = trim($fullName);
            return $fullName;
        }
    }
}

class FailException extends \Exception {

}