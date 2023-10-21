<?php

namespace Tests\Unit;

use App\Services\AnimalService;
use App\Types\Animals\Cat;
use App\Types\Animals\Dog;
use App\Types\Animals\Unicorn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimalServiceTest extends TestCase
{
    use RefreshDatabase;

    private AnimalService $service;

    public function setUp(): void
    {
        parent:: setUp();

        $this->service = new AnimalService;
    }

    public function test_find_predefined(): void
    {
        $this->assertSame(
            get_class($this->service->find('cat')),
            Cat::class
        );
    }

    public function test_is_imaginary(): void
    {
        $this->assertTrue(
            $this->service->isImaginary(new Unicorn)
        );
    }

    public function test_persist(): void
    {
        $animal = new Cat;
        $secondAnimal = new Dog;
        $name = fake()->firstName();

        $this->assertTrue(
            $this->service->persist($name, $animal)
        );
    }

    public function test_find_saved(): void
    {
        $animal = new Cat;
        $secondAnimal = new Dog;
        $name = fake()->firstName();

        $this->assertTrue(
            $this->service->persist($name, $animal),
        );

        $this->assertEquals(
            1,
            $this->service->findByName($name)->count(),
        );

        $this->assertEquals(
            1,
            $this->service->findByName($name, $animal->getName())->count(),
        );

        $this->assertTrue(
            $this->service->persist($name, $secondAnimal),
        );

        $this->assertGreaterThan(
            1,
            $this->service->findByName($name)->count(),
        );

        $this->assertEquals(
            1,
            $this->service->findByName($name, $secondAnimal->getName())->count(),
        );
    }
}
