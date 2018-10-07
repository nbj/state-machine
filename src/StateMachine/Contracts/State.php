<?php

namespace Nbj\StateMachine\Contracts;

interface State
{
    /**
     * Gets the identifier of the state
     *
     * @return string
     */
    public function getStateIdentifier();
}
