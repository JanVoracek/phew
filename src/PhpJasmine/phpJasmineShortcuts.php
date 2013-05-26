<?php
use PhpJasmine\GlobalContext,
    PhpJasmine\PositiveExpectation;

function describe($title, callable $fn = null) {
    $context = GlobalContext::getContext();
    $context->describe($title, $fn);
}

function xdescribe($title, callable $fn = null) {
    $context = GlobalContext::getContext();
    $context->xdescribe($title, $fn);
}

function it($title, callable $fn = null) {
    $context = GlobalContext::getContext();
    $context->it($title, $fn);
}

function xit($title, callable $fn = null) {
    $context = GlobalContext::getContext();
    $context->xit($title, $fn);
}

function beforeEach(callable $fn) {
    $context = GlobalContext::getContext();
    $context->beforeEach($fn);
}

function afterEach(callable $fn) {
    $context = GlobalContext::getContext();
    $context->afterEach($fn);
}

function fail($title) {
    $context = GlobalContext::getContext();
    $context->fail($title);
}

function expect($actual) {
    return new PositiveExpectation($actual);
}