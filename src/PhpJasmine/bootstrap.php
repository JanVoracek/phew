<?php
namespace PhpJasmine;

require_once __DIR__ . "/Context.php";
require_once __DIR__ . "/Example.php";
require_once __DIR__ . "/ExampleGroup.php";
require_once __DIR__ . "/Expectation.php";
require_once __DIR__ . "/Matcher.php";
require_once __DIR__ . "/Reporter.php";

require_once __DIR__ . "/GlobalContext.php";
require_once __DIR__ . "/phpJasmineShortcuts.php";


require_once __DIR__ . "/Matchers/ToBeMatcher.php";
require_once __DIR__ . "/Matchers/ToEqualMatcher.php";
require_once __DIR__ . "/Matchers/BooleanMatcher.php";
require_once __DIR__ . "/Matchers/RegularExpressionMatcher.php";

call_user_func(
    function () {
        $matchers = [
            'toBe' => ['PhpJasmine\\Matchers\\ToBeMatcher'],
            'toEqual' => ['PhpJasmine\\Matchers\\ToEqualMatcher'],
            'toBeTruthy' => ['PhpJasmine\\Matchers\\BooleanMatcher', true],
            'toBeFalsy' => ['PhpJasmine\\Matchers\\BooleanMatcher', false],
            'toBeNull' => ['PhpJasmine\\Matchers\\ToBeMatcher', null],
            'toMatch' => ['PhpJasmine\\Matchers\\RegularExpressionMatcher']
        ];
        Expectation::setMatchers($matchers);
    });