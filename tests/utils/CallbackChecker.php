<?php

class CallbackChecker {
    private $called = false;

    function __invoke() {
        $this->called = true;
    }

    public function wasCalled() {
        return $this->called;
    }
}