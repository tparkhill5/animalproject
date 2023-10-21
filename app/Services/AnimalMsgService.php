<?php

namespace App\Services;

use App\Types\Animals\Animal;
use Illuminate\Support\Str;

class AnimalMsgService
{
    public function says(string $name, Animal $animal): string
    {
        return sprintf('%s says "%s"', $name, $animal->says());
    }

    public function notReal(Animal $animal): string
    {
        return sprintf('%s are not real!', Str::plural($animal->getName()));
    }

    public function unknown(string $type): string
    {
        return sprintf('Sorry, I am not sure what sound a %s makes!', $type);
    }
}
