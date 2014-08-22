<?php

require_once dirname(__FILE__) . '/autoload.php';
require_once dirname(__FILE__) . '/phewShortcuts.php';

call_user_func(
    function () {
        $matchers = array(
            'toBe' => array('Phew\\Matchers\\Equality\\ToBeMatcher'),
            'toEqual' => array('Phew\\Matchers\\Equality\\ToEqualMatcher'),
            'toBeTruthy' => array('Phew\\Matchers\\Equality\\LooseBooleanMatcher', true),
            'toBeFalsy' => array('Phew\\Matchers\\Equality\\LooseBooleanMatcher', false),
            'toBeTrue' => array('Phew\\Matchers\\Equality\\ToBeMatcher', true),
            'toBeFalse' => array('Phew\\Matchers\\Equality\\ToBeMatcher', false),
            'toBeNull' => array('Phew\\Matchers\\Equality\\ToBeMatcher', null),
            'toBeEmpty' => array('Phew\\Matchers\\Equality\\ToEqualMatcher', null),
            'toMatch' => array('Phew\\Matchers\\String\\RegularExpressionMatcher'),
            'toBeA' => array('Phew\\Matchers\\Type\\TypeMatcher'),
            'toBeAn' => array('Phew\\Matchers\\Type\\TypeMatcher'),
            'toBeInstanceOf' => array('Phew\\Matchers\\Type\\TypeMatcher'),
            'toImplement' => array('Phew\\Matchers\\Type\\TypeMatcher'),
            'toStartWith' => array('Phew\\Matchers\\String\\PrefixMatcher'),
            'toEndWith' => array('Phew\\Matchers\\String\\SuffixMatcher'),
            'toContain' => array('Phew\\Matchers\\String\\SubstringMatcher'),
            'toHaveLength' => array('Phew\\Matchers\\String\\LengthMatcher'),
        );

        \Phew\Expectations\Expectation::setMatchers($matchers);
    }
);
