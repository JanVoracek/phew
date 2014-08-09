<?php
use PhpJasmine\Expectations\PositiveExpectation;
use PhpJasmine\GlobalContext;

/**
 * @param string $title
 * @param callable $fn
 */
function describe($title, $fn = null)
{
    $context = GlobalContext::getContext();
    $context->describe($title, $fn);
}

/**
 * @param string $title
 * @param callable $fn
 */
function xdescribe($title, $fn = null)
{
    $context = GlobalContext::getContext();
    $context->xdescribe($title, $fn);
}

/**
 * @param string $title
 * @param callable $fn
 */
function it($title, $fn = null)
{
    $context = GlobalContext::getContext();
    $context->it($title, $fn);
}

/**
 * @param string $title
 * @param callable $fn
 */
function xit($title, $fn = null)
{
    $context = GlobalContext::getContext();
    $context->xit($title, $fn);
}

/**
 * @param callable $fn
 */
function beforeEach($fn)
{
    $context = GlobalContext::getContext();
    $context->beforeEach($fn);
}

/**
 * @param callable $fn
 */
function afterEach($fn)
{
    $context = GlobalContext::getContext();
    $context->afterEach($fn);
}

function fail($title)
{
    $context = GlobalContext::getContext();
    $context->fail($title);
}

function expect($actual)
{
    return new PositiveExpectation($actual);
}