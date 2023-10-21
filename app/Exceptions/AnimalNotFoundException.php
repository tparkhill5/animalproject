<?php

namespace App\Exceptions;

/**
 * @codeCoverageIgnore
 */
class AnimalNotFoundException extends \Exception
{
    public function __construct(
        private readonly string $type,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($this->formatted(), $code, $previous);
    }

    private function formatted(): string
    {
        return sprintf('Unknown animal type %s', $this->type);
    }

    public function __toString(): string
    {
        return $this->formatted();
    }
}
