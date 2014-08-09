<?php

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
        $thrownException = new Exception("some message");
        $reporter = $this->getMock('\PhpJasmine\Reporter');
        $example = new \PhpJasmine\Example("", function() use ($thrownException) { throw $thrownException; });
        $reporter->expects($this->once())->method('reportFailedExample')->with($this->equalTo($example), $this->equalTo($thrownException));

        $example->run($reporter);
    }

    public function test_exampleGroupOnFailureExampleCallsReporterWithReferenceToItselfAndTheException() {
        $thrownException = new Exception("some message");
        $reporter = $this->getMock('\PhpJasmine\Reporter');
        $example = $this->getMockBuilder('\PhpJasmine\Example')->disableOriginalConstructor()->getMock();
        $example->expects($this->any())->method('run')->will($this->throwException($thrownException));

        $exampleGroup = new \PhpJasmine\ExampleGroup("");
        $exampleGroup->add($example);
        $reporter->expects($this->once())->method('reportFailedExample')->with($this->equalTo($exampleGroup), $this->equalTo($thrownException));

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