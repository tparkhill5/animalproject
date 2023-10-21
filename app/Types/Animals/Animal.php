<?php

namespace App\Types\Animals;

/**
 * @codeCoverageIgnore
 */
abstract class Animal
{
    protected ?string $name = null;

    abstract public function says(): string;

    public function called(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name ?? (new \ReflectionClass($this))->getShortName();
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
