<?php

namespace Tests\Unit;

use App\Services\AnimalMsgService;
use App\Types\Animals\Animal;
use App\Types\Animals\Cat;
use App\Types\Animals\Unicorn;
use Tests\TestCase;

class AnimalMsgServiceTest extends TestCase
{
    private AnimalMsgService $service;

    public function setUp(): void
    {
        parent:: setUp();

        $this->service = new AnimalMsgService;
    }

    public function test_msg_says(): void
    {
        $name = fake()->firstName;

        $this->assertSame(
            "{$name} says \"meow\"",
            $this->service->says($name, new Cat)
        );
    }

    public function test_msg_not_real(): void
    {
        $this->assertSame(
            'Unicorns are not real!',
            $this->service->notReal(new Unicorn)
        );
    }

    public function test_msg_unknown(): void
    {
        $name = 'snake';

        $this->assertSame(
            "Sorry, I am not sure what sound a {$name} makes!",
            $this->service->unknown($name)
        );
    }
}
