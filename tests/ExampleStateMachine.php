<?php

namespace Tests;

use Nbj\StateMachine\StateMachine;

class ExampleStateMachine extends StateMachine
{
    /**
     * Holds all the individual state identifiers
     *
     * @var array $stateIdentifiers
     */
    protected $stateIdentifiers = [
        'stateOne',
        'stateTwo',
        'stateThree',
        'stateFour'
    ];

    /**
     * Holds all the possible transition between states
     *
     * @var array $stateTransitions
     */
    protected $stateTransitions = [
        'stateOne' => [
            'stateTwo',
            'stateFour',
        ],
        'stateTwo' => [
            'stateThree',
        ]
    ];

    /**
     * Holds the initial state identifier
     * for changes made from no state
     *
     * @var string $initialStateIdentifier
     */
    protected $initialStateIdentifier = 'stateOne';

    /**
     * Example of change modifier
     *
     * @return bool
     */
    protected function changeToStateFour()
    {
        return (bool) $this->objectChangingState->canChangeState;
    }
}
