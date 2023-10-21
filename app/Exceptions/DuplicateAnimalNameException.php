<?php

namespace App\Exceptions;

/**
 * @codeCoverageIgnore
 */
class DuplicateAnimalNameException extends \Exception
{
    public function __construct(
        private readonly string $name,
        private readonly string $type,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($this->formatted(), $code, $previous);
    }

    private function formatted(): string
    {
        return sprintf('Already have a(n) %s named %s', $this->type, $this->name);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->formatted();
    }
}
