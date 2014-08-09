<?php
namespace PhpJasmine;

use PhpJasmine\Expectations\ExpectationException;

class Reporter {
    public function reportSucceededExample(Example $example) {
        echo ".";
    }

    public function reportFailedExample(Example $example, \Exception $ex) {
        $message = "failed: " . $example->getName() . ": ";
        if ($ex instanceof ExpectationException || $ex instanceof FailException) {
            $message .= $ex->getMessage();
        } else {
            $message .= sprintf("Unexpected exception: %s on line %d in file %s: %s", get_class($ex), $ex->getLine(), $ex->getFile(), $ex->getMessage());
        }

        echo "F";
    }
}
