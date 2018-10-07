<?php

namespace Tests;

use Nbj\StateMachine\Contracts\State;

class StateOne implements State
{
    /**
     * Gets the identifier of the state
     *
     * @return string
     */
    public function getStateIdentifier()
    {
        return 'stateOne';
    }
}
