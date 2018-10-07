<?php

namespace Nbj\StateMachine\Exceptions;

use Exception;
use Throwable;

class StateMachineNotInitialized extends Exception
{
    /**
     * StateMachineNotInitialized constructor.
     *
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($code = 500, Throwable $previous = null)
    {
        $message = 'A StateMachine must be initialized in the class constructor';

        parent::__construct($message, $code, $previous);
    }
}
