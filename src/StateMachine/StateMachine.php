<?php

namespace Nbj\StateMachine;

use Nbj\StateMachine\Contracts\State;

abstract class StateMachine
{
    /**
     * Holds all the individual state identifiers
     *
     * @var array $stateIdentifiers
     */
    protected $stateIdentifiers = [];

    /**
     * Holds all the possible transition between states
     *
     * @var array $stateTransitions
     */
    protected $stateTransitions = [];

    /**
     * Holds the initial state identifier
     * for changes made from no state
     *
     * @var string $initialStateIdentifier
     */
    protected $initialStateIdentifier;

    /**
     * Holds the from state
     *
     * @var State $fromState
     */
    protected $fromState;

    /**
     * Holds the to state
     *
     * @var State $toState
     */
    protected $toState;

    /**
     * Holds the object which state is changing
     *
     * @var object $objectChangingState
     */
    protected $objectChangingState;

    /**
     * Syntactic sugar for setting the from state
     *
     * @param State $state
     *
     * @return $this
     */
    public function allows(State $state = null)
    {
        return $this->setFromState($state);
    }

    /**
     * Syntactic sugar for setting the to state
     *
     * @param State $state
     *
     * @return StateMachine
     */
    public function to(State $state)
    {
        return $this->setToState($state);
    }

    /**
     * Sets the object that is changing state
     * and checks if the change is allowed
     *
     * @param $object
     *
     * @return bool
     */
    public function for($object)
    {
        $this->objectChangingState = $object;

        return $this->checkIfStateChangeIsAllowed();
    }

    /**
     * Sets the from state
     *
     * @param State $state
     *
     * @return $this
     */
    public function setFromState(State $state = null)
    {
        $this->fromState = $state;

        return $this;
    }

    /**
     * Sets the to state
     *
     * @param State $state
     *
     * @return $this
     */
    public function setToState(State $state)
    {
        $this->toState = $state;

        return $this;
    }

    /**
     * Checks if state change is allowed
     *
     * @return bool
     */
    protected function checkIfStateChangeIsAllowed()
    {
        if ($this->fromState == null) {
            return $this->handleInitialStateChange();
        }

        return $this->handleRegularStateChange();
    }

    /**
     * Handles initial state changes
     *
     * @return bool
     */
    protected function handleInitialStateChange()
    {
        if ($this->toState->getStateIdentifier() != $this->initialStateIdentifier) {
            return false;
        }

        return true;
    }

    /**
     * Handles regular state changes
     *
     * @return bool
     */
    protected function handleRegularStateChange()
    {
        $allowedStates = $this->stateTransitions[$this->fromState->getStateIdentifier()];

        if (!in_array($this->toState->getStateIdentifier(), $allowedStates)) {
            return false;
        }

        return true;
    }
}
