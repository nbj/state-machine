<?php

namespace Nbj\StateMachine\Exceptions;

use Exception;
use Throwable;

class StateChangeNotAllowed extends Exception
{
    /**
     * StateChangeNotAllowed constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
