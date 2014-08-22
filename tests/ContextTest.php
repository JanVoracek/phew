<?php

require_once __DIR__ . '/utils/CallbackChecker.php';

class ContextTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Phew\Context;
     */
    public $context;

    protected function setUp()
    {
        parent::setUp();
        $this->context = new \Phew\Context();
    }

    public function test_callbackOfDescribeShouldBeCalled()
    {

        $callback = new CallbackChecker();
        $this->context->describe("active test", $callback);
        $this->context->runExamples();
        $this->assertTrue($callback->wasCalled());
    }

    public function test_callbackOfXdescribeShouldNotBeCalled()
    {
        $callback = new CallbackChecker();
        $this->context->xdescribe("inactive test", $callback);
        $this->context->runExamples();
        $this->assertFalse($callback->wasCalled());
    }

    public function test_callbackOfItShouldBeCalled()
    {

        $callback = new CallbackChecker();
        $this->context->it("active test", $callback);
        $this->context->runExamples();
        $this->assertTrue($callback->wasCalled());
    }

    public function test_callbackOfXitShouldNotBeCalled()
    {
        $callback = new CallbackChecker();
        $this->context->xit("inactive test", $callback);
        $this->context->runExamples();
        $this->assertFalse($callback->wasCalled());
    }

    public function test_beforeEachShouldBeCalledExactlyAsManyTimesAsThereAreExamples()
    {
        $callback = $this->getMock("CallbackChecker");
        $randomExampleCount = 5;
        for ($i = 0; $i < $randomExampleCount; $i++) {
            $this->context->it(
                "",
                function () {
                }
            );
        }
        $this->context->beforeEach($callback);
        $callback->expects($this->exactly($randomExampleCount))->method("__invoke");
        $this->context->runExamples();
    }

    public function test_afterEachShouldBeCalledExactlyAsManyTimesAsThereAreExamples()
    {
        $callback = $this->getMock("CallbackChecker");
        $randomExampleCount = 5;
        for ($i = 0; $i < $randomExampleCount; $i++) {
            $this->context->it(
                "",
                function () {
                }
            );
        }
        $this->context->afterEach($callback);
        $callback->expects($this->exactly($randomExampleCount))->method("__invoke");
        $this->context->runExamples();
    }

    public function test_beforeEachShouldBeCalledForExamplesNestedInAnotherExampleGroup()
    {
        $callback = $this->getMock("CallbackChecker");

        $this->context->it(
            "",
            function () {
            }
        );

        $that = $this;
        $this->context->describe(
            "",
            function () use ($that) {
                $nestedCallback = new CallbackChecker();
                $that->context->it("", $nestedCallback);
            }
        );

        $this->context->beforeEach($callback);
        $callback->expects($this->exactly(2))->method("__invoke");
        $this->context->runExamples();
    }

    /**
     * @expectedException \Phew\Exceptions\FailException
     * @expectedExceptionMessage Some message
     */
    public function test_contextShouldThrowOnFail()
    {
        $message = "Some message";
        $this->context->fail($message);
    }

    /**
     * @expectedException \Phew\Exceptions\FailException
     * @expectedExceptionMessage Unexpected exception
     */
    public function test_throwingDescribeShouldFailWithUnexpectedExceptionError()
    {
        $this->context->describe(
            "",
            function () {
                throw new Exception("some title");
            }
        );
    }
}