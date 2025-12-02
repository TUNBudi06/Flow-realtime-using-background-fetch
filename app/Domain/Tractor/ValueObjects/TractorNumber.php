<?php

declare(strict_types=1);

namespace App\Domain\Tractor\ValueObjects;

use InvalidArgumentException;

final readonly class TractorNumber
{
    private function __construct(
        private string $value
    ) {}

    public static function create(string $value): self
    {
        $trimmed = trim($value);

        if ($trimmed === '') {
            throw new InvalidArgumentException('Tractor number cannot be empty');
        }

        return new self($trimmed);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(TractorNumber $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
