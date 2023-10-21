<?php

namespace Tests\Unit;

use App\Types\Animals\Cat;
use App\Types\Animals\Cow;
use App\Types\Animals\Dog;
use App\Types\Animals\Unicorn;
use Tests\TestCase;

class TypesTest extends TestCase
{
    public function test_animals(): void
    {
        $this->assertSame(
            'meow',
            (new Cat)->says()
        );

        $this->assertSame(
            'Woof!',
            (new Dog)->says()
        );

        $this->assertSame(
            'Moo',
            (new Cow)->says()
        );

        $this->assertEmpty(
            (new Unicorn)->says()
        );
    }
}
