<?php
namespace PhpJasmine;

class GlobalContext
{
    private function __construct()
    {
    }

    private static $context = null;

    /**
     * @return Context
     */
    public static function getContext()
    {
        if (self::$context == null) {
            self::$context = new Context();
        }
        return self::$context;
    }

    public static function setContext(Context $context = null)
    {
        self::$context = $context;
    }
}