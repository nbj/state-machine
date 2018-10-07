<?php

namespace Tests;

use Nbj\StateMachine\Traits\ChangesState;

class Example
{
    // Allows for state changes
    use ChangesState;

    public $canChangeState;

    public function __construct()
    {
        // A state machine must be initialized before changing state is possible
        $this->initializeStateMachine(new ExampleStateMachine);
    }
}
