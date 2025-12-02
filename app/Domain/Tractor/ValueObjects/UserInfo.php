<?php

declare(strict_types=1);

namespace App\Domain\Tractor\ValueObjects;

final readonly class UserInfo
{
    private function __construct(
        private string $name,
        private string $nik
    ) {}

    public static function create(string $name, string $nik): self
    {
        return new self(
            trim($name),
            trim($nik)
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function nik(): string
    {
        return $this->nik;
    }

    public function equals(UserInfo $other): bool
    {
        return $this->name === $other->name && $this->nik === $other->nik;
    }
}
