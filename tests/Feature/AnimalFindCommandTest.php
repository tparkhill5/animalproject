<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimalFindCommandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_find_name(): void
    {
        $name = fake()->firstName();

        $this->artisan('animal:says', ['name' => $name, 'type' => 'cat', '--save' => true])
            ->expectsOutput('Saved!')
            ->assertExitCode(0);

        $this->artisan('animal:find', ['name' => $name])
            ->expectsOutputToContain('Name: '.$name)
            ->expectsOutputToContain('TypeName: cat')
            ->expectsOutputToContain('IsImaginary:')
            ->expectsOutputToContain('Says: meow')
            ->assertExitCode(0);
    }

    public function test_dont_find_name(): void
    {
        $name = fake()->firstName();
        $badname = $name.'NOFIND';

        $this->artisan('animal:says', ['name' => $name, 'type' => 'cat', '--save' => true])
            ->expectsOutput('Saved!')
            ->assertExitCode(0);

        $this->artisan('animal:find', ['name' => $badname])
            ->expectsOutput("No results for {$badname}")
            ->assertExitCode(0);
    }

    public function test_find_name_choice(): void
    {
        $name = fake()->firstName();

        $this->artisan('animal:says', ['name' => $name, 'type' => 'cat', '--save' => true])
            ->expectsOutput('Saved!')
            ->assertExitCode(0);

        $this->artisan('animal:says', ['name' => $name, 'type' => 'dog', '--save' => true])
            ->expectsOutput('Saved!')
            ->assertExitCode(0);

        $this->artisan('animal:find', ['name' => $name])
            ->expectsQuestion("Multiple entries found for the name {$name}, please select the type", 'dog')
            ->expectsOutputToContain('Name: '.$name)
            ->expectsOutputToContain('TypeName: dog')
            ->expectsOutputToContain('IsImaginary:')
            ->expectsOutputToContain('Says: Woof!')
            ->assertExitCode(0);
    }

    public function test_find_name_type(): void
    {
        $name = fake()->firstName();

        $this->artisan('animal:says', ['name' => $name, 'type' => 'cat', '--save' => true])
            ->expectsOutput('Saved!')
            ->assertExitCode(0);

        $this->artisan('animal:says', ['name' => $name, 'type' => 'dog', '--save' => true])
            ->expectsOutput('Saved!')
            ->assertExitCode(0);

        $this->artisan('animal:find', ['name' => $name, 'type' => 'dog'])
            ->expectsOutputToContain('Name: '.$name)
            ->expectsOutputToContain('TypeName: dog')
            ->expectsOutputToContain('IsImaginary:')
            ->expectsOutputToContain('Says: Woof!')
            ->assertExitCode(0);
    }
}
