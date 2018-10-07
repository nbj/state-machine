<?php

namespace Nbj\StateMachine\Traits;

use Nbj\StateMachine\StateMachine;
use Nbj\StateMachine\Contracts\State;
use Nbj\StateMachine\Exceptions\StateChangeNotAllowed;
use Nbj\StateMachine\Exceptions\StateMachineNotInitialized;

trait ChangesState
{
    /**
     * Hold the state
     *
     * @var State $state
     */
    protected $state;

    /**
     * Holds the state machine once set
     *
     * @var StateMachine $stateMachine
     */
    protected static $stateMachine;

    /**
     * Initializes a state machine for the class
     *
     * @param StateMachine $stateMachine
     *
     * @return static
     */
    public function initializeStateMachine(StateMachine $stateMachine)
    {
        static::$stateMachine = $stateMachine;

        return $this;
    }

    /**
     * Gets the currently set state
     *
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Sets the state
     *
     * @param State $state
     *
     * @return $this
     *
     * @throws StateChangeNotAllowed
     * @throws StateMachineNotInitialized
     */
    public function setState(State $state)
    {
        if (!static::$stateMachine) {
            throw new StateMachineNotInitialized;
        }

        if (!static::$stateMachine->allows($this->state)->to($state)->for($this)) {
            $message = sprintf(
                "State change from [%s] to [%s] is not allowed",
                $this->state ? $this->state->getStateIdentifier() : 'null',
                $state->getStateIdentifier()
            );

            throw new StateChangeNotAllowed($message);
        }

        $this->state = $state;

        return $this;
    }
}
