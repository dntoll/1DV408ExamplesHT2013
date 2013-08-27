<?php


function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

	case E_NOTICE:
    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr $errfile $errline<br />\n";
		var_dump(debug_backtrace());
        break;

    default:
        echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

error_reporting(E_ALL);


set_error_handler("myErrorHandler");

echo (E_ERROR | E_WARNING);


function experiment() {
	echo $error;
}

experiment();
