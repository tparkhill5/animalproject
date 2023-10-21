<?php

namespace App\Types\Sounds;

/**
 * @codeCoverageIgnore
 */
abstract class Sound
{
    protected string $value = 'unkown';

    abstract protected function capitalize(string $in): string;

    abstract protected function punctuate(string $in): string;

    public function get(): string
    {
        return $this->capitalize($this->punctuate($this->value));
    }

    public function set(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
