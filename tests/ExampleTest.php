<?php

require_once __DIR__ . '/../src/Example.php';
require_once __DIR__ . '/../src/Reporter.php';
require_once __DIR__ . '/utils/CallbackChecker.php';

class ExampleTest extends PHPUnit_Framework_TestCase {

    public function test_exampleIsNotExecutedBeforeRunIsCalled() {
        $callback = new CallbackChecker();
        new \PhpJasmine\Example("", $callback);
        $this->assertFalse($callback->wasCalled());
    }

    public function test_runExecutesTheExample() {
        $callback = new CallbackChecker();
        $example = new \PhpJasmine\Example("", $callback);
        $example->run($this->getMock('\PhpJasmine\Reporter'));
        $this->assertTrue($callback->wasCalled());
    }

    public function test_onFailureExampleCallsReporterWithReferenceToItselfAndTheException() {
        $throwedException = new Exception("some message");
        $reporter = $this->getMock('\PhpJasmine\Reporter');
        $example = new \PhpJasmine\Example("", function() use ($throwedException) { throw $throwedException; });
        $reporter->expects($this->once())->method('reportFailedExample')->with($this->equalTo($example), $this->equalTo($throwedException));

        $example->run($reporter);
    }

    public function test_exampleGroupOnFailureExampleCallsReporterWithReferenceToItselfAndTheException() {
        $throwedException = new Exception("some message");
        $reporter = $this->getMock('\PhpJasmine\Reporter');
        $example = $this->getMockBuilder('\PhpJasmine\Example')->disableOriginalConstructor()->getMock();
        $example->expects($this->any())->method('run')->will($this->throwException($throwedException));

        $exampleGroup = new \PhpJasmine\ExampleGroup("");
        $exampleGroup->add($example);
        $reporter->expects($this->once())->method('reportFailedExample')->with($this->equalTo($exampleGroup), $this->equalTo($throwedException));

        $exampleGroup->run($reporter);
    }

    /**
     * Only for 100% code coverage...
     */
    public function test_exampleShouldGiveBackItsName(){
        $exampleName = "some name";
        $example = new \PhpJasmine\Example($exampleName, function(){});
        $this->assertEquals($exampleName, $example->getName());
    }
}