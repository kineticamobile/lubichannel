<?php

namespace Kineticamobile\Ubicual\Tests;

use Kineticamobile\Ubicual\UbicualMessage;
use Kineticamobile\Ubicual\Test\TestCase;

class UbicualMessageTest extends TestCase
{
    /** @test */
    public function it_can_accept_a_content_when_constructing_a_message(): void
    {
        $message = new UbicualMessage('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_content(): void
    {
        $message = (new UbicualMessage())->content('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_from(): void
    {
        $message = (new UbicualMessage())->from('Ubicual');

        $this->assertEquals('Ubicual', $message->from);
    }
}
