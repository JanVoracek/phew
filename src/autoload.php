<?php

function __autoload($className) {
    $firstNamespaceDelimiterPosition = strpos($className, "\\");
    $classPath = substr($className, $firstNamespaceDelimiterPosition);
    $classPath = str_replace("\\", "/", $classPath);

    $path = __DIR__ . "/" . $classPath . ".php";
    if(is_file($path))
        require_once($path);
}
spl_autoload_register("__autoload");