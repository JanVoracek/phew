<?php
namespace PhpJasmine;

define("DS", DIRECTORY_SEPARATOR);

require_once __DIR__ . DS . "Context.php";
require_once __DIR__ . DS . "Example.php";
require_once __DIR__ . DS . "ExampleGroup.php";
require_once __DIR__ . DS . "Expectation.php";
require_once __DIR__ . DS . "Matcher.php";
require_once __DIR__ . DS . "Reporter.php";

require_once __DIR__ . DS . "GlobalContext.php";
require_once __DIR__ . DS . "phpJasmineShortcuts.php";


require_once __DIR__ . DS . "Matchers" . DS . "ToBeMatcher.php";
require_once __DIR__ . DS . "Matchers" . DS . "ToEqualMatcher.php";
require_once __DIR__ . DS . "Matchers" . DS . "BooleanMatcher.php";

call_user_func(
    function () {
        $matchers = [
            'toBe' => ['PhpJasmine\\Matchers\\ToBeMatcher'],
            'toEqual' => ['PhpJasmine\\Matchers\\ToEqualMatcher'],
            'toBeTruthy' => ['PhpJasmine\\Matchers\\BooleanMatcher', true],
            'toBeFalsy' => ['PhpJasmine\\Matchers\\BooleanMatcher', false],
            'toBeNull' => ['PhpJasmine\\Matchers\\ToBeMatcher', null]
        ];
        Expectation::setMatchers($matchers);
    });