<?php

namespace Tests;

use Nbj\StateMachine\Contracts\State;

class StateThree implements State
{
    /**
     * Gets the identifier of the state
     *
     * @return string
     */
    public function getStateIdentifier()
    {
        return 'stateThree';
    }
}
