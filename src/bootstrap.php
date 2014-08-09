<?php

require_once dirname(__FILE__) . '/autoload.php';
require_once dirname(__FILE__) . '/phpJasmineShortcuts.php';

call_user_func(
    function () {
        $matchers = array(
            'toBe' => array('PhpJasmine\\Matchers\\Equality\\ToBeMatcher'),
            'toEqual' => array('PhpJasmine\\Matchers\\Equality\\ToEqualMatcher'),
            'toBeTruthy' => array('PhpJasmine\\Matchers\\Equality\\LooseBooleanMatcher', true),
            'toBeFalsy' => array('PhpJasmine\\Matchers\\Equality\\LooseBooleanMatcher', false),
            'toBeTrue' => array('PhpJasmine\\Matchers\\Equality\\ToBeMatcher', true),
            'toBeFalse' => array('PhpJasmine\\Matchers\\Equality\\ToBeMatcher', false),
            'toBeNull' => array('PhpJasmine\\Matchers\\Equality\\ToBeMatcher', null),
            'toMatch' => array('PhpJasmine\\Matchers\\String\\RegularExpressionMatcher')
        );

        \PhpJasmine\Expectations\Expectation::setMatchers($matchers);
    });