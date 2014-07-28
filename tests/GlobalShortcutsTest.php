<?php
require_once __DIR__ . '/../src/GlobalContext.php';
require_once __DIR__ . '/../src/Expectation.php';
require_once __DIR__ . '/../src/phpJasmineShortcuts.php';
require_once __DIR__ . '/utils/CallbackChecker.php';

class GlobalShortcutsTest extends PHPUnit_Framework_TestCase {

    private $title;
    private $callback;

    protected function setUp() {
        $this->title = "random_title";
        $this->callback = new CallbackChecker();
    }

    protected function tearDown() {
        \PhpJasmine\GlobalContext::setContext(null); // reset
    }

    public function test_describeCallsContextDescribe() {
        $this->checkStructureShortcut("describe");
    }

    public function test_xdescribeCallsContextXdescribe() {
        $this->checkStructureShortcut("xdescribe");
    }

    public function test_itCallsContextIt() {
        $this->checkStructureShortcut("it");
    }

    public function test_xitCallsContextXit() {
        $this->checkStructureShortcut('xit');
    }

    public function test_beforeEachCallsContextBeforeEach() {
        $this->checkFunctionShortcut('beforeEach');
    }

    public function test_afterEachCallsContextAfterEach() {
        $this->checkFunctionShortcut('afterEach');
    }

    public function test_expectCallsContextExpect() {
        $expectation = expect("some value");
        $this->assertInstanceOf('\PhpJasmine\PositiveExpectation', $expectation);
    }

    private function checkStructureShortcut($shortcutName) {
        $context = $this->getMock('PhpJasmine\Context', array($shortcutName));
        \PhpJasmine\GlobalContext::setContext($context);

        $context->expects($this->once())->method($shortcutName)->with($this->identicalTo($this->title), $this->identicalTo($this->callback));
        $shortcutName($this->title, $this->callback);
    }

    private function checkFunctionShortcut($shortcutName) {
        $context = $this->getMock('PhpJasmine\Context', array($shortcutName));
        \PhpJasmine\GlobalContext::setContext($context);

        $context->expects($this->once())->method($shortcutName)->with($this->identicalTo($this->callback));
        $shortcutName($this->callback);
    }
}
