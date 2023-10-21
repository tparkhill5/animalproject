<?php

namespace Database\Seeders;

use App\Models\AnimalType;
use Illuminate\Database\Seeder;

class AnimalTypeSeeder extends Seeder
{
    const DEFAULT_TYPES = [
        ['cat', 'meow', false],
        ['dog', 'Woof!', false],
        ['cow', 'moo', false],
        ['unicorn', null, true],
        ['crow', 'caw', false],
        ['dragon', null, true],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::DEFAULT_TYPES as $data) {
            [$name, $sound, $is_imaginary] = $data;

            AnimalType::create([
                'name' => $name,
                'sound' => $sound,
                'is_imaginary' => $is_imaginary,
            ]);
        }
    }
}
