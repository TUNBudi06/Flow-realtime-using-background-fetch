<?php

declare(strict_types=1);

namespace App\Domain\Tractor\ValueObjects;

use InvalidArgumentException;

/**
 * @phpstan-type ProductionTypeEnum 'mainline'|'inspeksi'|'delivery'
 */
final readonly class ProductionType
{
    public const MAINLINE = 'mainline';

    public const INSPEKSI = 'inspeksi';

    public const DELIVERY = 'delivery';

    private const VALID_TYPES = [
        self::MAINLINE,
        self::INSPEKSI,
        self::DELIVERY,
    ];

    private function __construct(
        private string $value
    ) {}

    public static function mainline(): self
    {
        return new self(self::MAINLINE);
    }

    public static function inspeksi(): self
    {
        return new self(self::INSPEKSI);
    }

    public static function delivery(): self
    {
        return new self(self::DELIVERY);
    }

    public static function fromString(string $value): self
    {
        $normalized = strtolower(trim($value));

        if (! in_array($normalized, self::VALID_TYPES, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid production type: %s. Valid types are: %s',
                    $value,
                    implode(', ', self::VALID_TYPES)
                )
            );
        }

        return new self($normalized);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isMainline(): bool
    {
        return $this->value === self::MAINLINE;
    }

    public function isInspeksi(): bool
    {
        return $this->value === self::INSPEKSI;
    }

    public function isDelivery(): bool
    {
        return $this->value === self::DELIVERY;
    }

    public function displayName(): string
    {
        return match ($this->value) {
            self::MAINLINE => 'Mainline',
            self::INSPEKSI => 'Inspeksi',
            self::DELIVERY => 'Delivery',
        };
    }

    public function equals(ProductionType $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
