<?php

namespace Tests;

use Nbj\StateMachine\Traits\ChangesState;

class ExampleUninitialized
{
    // Allows for state changes
    use ChangesState;

    public function __construct()
    {
    }
}
