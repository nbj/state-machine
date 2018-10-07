<?php

namespace Tests\Feature;

use Tests\Example;
use Tests\StateOne;
use Tests\StateTwo;
use Tests\StateFour;
use Tests\StateThree;
use Tests\ExampleStateMachine;
use PHPUnit\Framework\TestCase;
use Tests\ExampleUninitialized;
use Nbj\StateMachine\StateMachine;
use Nbj\StateMachine\Exceptions\StateChangeNotAllowed;
use Nbj\StateMachine\Exceptions\StateMachineNotInitialized;

class StateMachineTest extends TestCase
{
    /** @test */
    public function a_class_that_inherits_state_machine_can_be_newed_up()
    {
        $stateMachine = new ExampleStateMachine;

        $this->assertInstanceOf(StateMachine::class, $stateMachine);
    }

    /** @test */
    public function it_allows_object_with_no_state_to_change_to_initial_state()
    {
        $object = new Example;

        $this->assertNull($object->getState());

        $object->setState(new StateOne);

        $this->assertInstanceOf(StateOne::class, $object->getState());
    }

    /** @test */
    public function it_does_not_allow_object_with_no_state_to_change_to_any_state()
    {
        $object = new Example;

        $this->assertNull($object->getState());

        $this->expectException(StateChangeNotAllowed::class);
        $this->expectExceptionMessage('State change from [null] to [stateTwo] is not allowed');

        $object->setState(new StateTwo);

        $this->assertNull($object->getState());
    }

    /** @test */
    public function it_does_not_allow_state_changes_before_a_state_machine_has_been_initialized()
    {
        $object = new ExampleUninitialized;

        $this->assertNull($object->getState());

        $this->expectException(StateMachineNotInitialized::class);
        $this->expectExceptionMessage('A StateMachine must be initialized in the class constructor');

        $object->setState(new StateTwo);

        $this->assertNull($object->getState());
    }

    /** @test */
    public function it_allows_state_changes()
    {
        $object = new Example;
        $object->setState(new StateOne);
        $this->assertInstanceOf(StateOne::class, $object->getState());

        $object->setState(new StateTwo);
        $this->assertInstanceOf(StateTwo::class, $object->getState());

        $object->setState(new StateThree);
        $this->assertInstanceOf(StateThree::class, $object->getState());
    }

    /** @test */
    public function it_does_not_allow_invalid_state_changes()
    {
        $object = new Example;
        $object->setState(new StateOne);
        $this->assertInstanceOf(StateOne::class, $object->getState());

        $this->expectException(StateChangeNotAllowed::class);
        $this->expectExceptionMessage('State change from [stateOne] to [stateThree] is not allowed');

        $object->setState(new StateThree);
    }

    /** @test */
    public function it_takes_changeTo_methods_into_account()
    {
        $objectA = new Example;
        $objectA->setState(new StateOne);
        $objectA->canChangeState = true;
        $this->assertInstanceOf(StateOne::class, $objectA->getState());

        $objectA->setState(new StateFour);
        $this->assertInstanceOf(StateFour::class, $objectA->getState());

        $objectB = new Example;
        $objectB->setState(new StateOne);
        $objectB->canChangeState = false;
        $this->assertInstanceOf(StateOne::class, $objectB->getState());

        $this->expectException(StateChangeNotAllowed::class);
        $this->expectExceptionMessage('State change from [stateOne] to [stateFour] is not allowed');

        $objectB->setState(new StateFour);
        $this->assertInstanceOf(StateOne::class, $objectB->getState());
    }
}
