<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimalSaysCommandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_cat_meow(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'cat')
            ->expectsOutput('Mr Pickles says "meow"')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }

    public function test_cow_moo(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'cow')
            ->expectsOutput('Mr Pickles says "Moo"')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }

    public function test_dog_woof(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'dog')
            ->expectsOutput('Mr Pickles says "Woof!"')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }

    public function test_crow_caw(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'crow')
            ->expectsOutput('Mr Pickles says "caw"')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }

    public function test_unicorn(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'unicorn')
            ->expectsOutput('Unicorns are not real!')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }

    public function test_dragon(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'dragon')
            ->expectsOutput('dragons are not real!')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }

    public function test_save_animal(): void
    {
        $this->artisan('animal:says', ['name' => 'Mr Pickles', 'type' => 'cat', '--save' => true])
            ->expectsOutput('Mr Pickles says "meow"')
            ->expectsOutput('Saving Mr Pickles the Cat to the database..')
            ->expectsOutput('Saved!')
            ->assertExitCode(0);
    }

    public function test_save_dup_animal(): void
    {
        $this->artisan('animal:says', ['name' => 'Mr Pickles', 'type' => 'cat', '--save' => true])
            ->assertExitCode(0);

        $this->artisan('animal:says', ['name' => 'Mr Pickles', 'type' => 'cat', '--save' => true])
            ->expectsOutput('Mr Pickles says "meow"')
            ->expectsOutput('Saving Mr Pickles the Cat to the database..')
            ->expectsOutputToContain('Oops, looks like we already have')
            ->assertExitCode(0);
    }

    public function test_unknown_animal(): void
    {
        $this->artisan('animal:says')
            ->expectsQuestion('What is the name of your animal?', 'Mr Pickles')
            ->expectsQuestion('What is the type or species of your animal?', 'axolotl')
            ->expectsOutput('Sorry, I am not sure what sound a axolotl makes!')
            ->doesntExpectOutput('Mr Pickles says "moo"')
            ->assertExitCode(0);
    }
}
