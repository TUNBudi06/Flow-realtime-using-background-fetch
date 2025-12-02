<?php

use App\Domain\Tractor\ValueObjects\ProductionType;

describe('ProductionType', function () {
    it('creates mainline production type', function () {
        $type = ProductionType::mainline();

        expect($type->value())->toBe('mainline')
            ->and($type->isMainline())->toBeTrue()
            ->and($type->isInspeksi())->toBeFalse()
            ->and($type->isDelivery())->toBeFalse()
            ->and($type->displayName())->toBe('Mainline');
    });

    it('creates inspeksi production type', function () {
        $type = ProductionType::inspeksi();

        expect($type->value())->toBe('inspeksi')
            ->and($type->isMainline())->toBeFalse()
            ->and($type->isInspeksi())->toBeTrue()
            ->and($type->isDelivery())->toBeFalse()
            ->and($type->displayName())->toBe('Inspeksi');
    });

    it('creates delivery production type', function () {
        $type = ProductionType::delivery();

        expect($type->value())->toBe('delivery')
            ->and($type->isMainline())->toBeFalse()
            ->and($type->isInspeksi())->toBeFalse()
            ->and($type->isDelivery())->toBeTrue()
            ->and($type->displayName())->toBe('Delivery');
    });

    it('creates from string value', function () {
        $mainline = ProductionType::fromString('mainline');
        $inspeksi = ProductionType::fromString('inspeksi');
        $delivery = ProductionType::fromString('delivery');

        expect($mainline->isMainline())->toBeTrue()
            ->and($inspeksi->isInspeksi())->toBeTrue()
            ->and($delivery->isDelivery())->toBeTrue();
    });

    it('handles case-insensitive string values', function () {
        $type1 = ProductionType::fromString('MAINLINE');
        $type2 = ProductionType::fromString('Inspeksi');
        $type3 = ProductionType::fromString('DELIVERY');

        expect($type1->isMainline())->toBeTrue()
            ->and($type2->isInspeksi())->toBeTrue()
            ->and($type3->isDelivery())->toBeTrue();
    });

    it('throws exception for invalid production type', function () {
        ProductionType::fromString('invalid');
    })->throws(InvalidArgumentException::class, 'Invalid production type');

    it('compares equality correctly', function () {
        $type1 = ProductionType::mainline();
        $type2 = ProductionType::mainline();
        $type3 = ProductionType::delivery();

        expect($type1->equals($type2))->toBeTrue()
            ->and($type1->equals($type3))->toBeFalse();
    });

    it('converts to string', function () {
        $type = ProductionType::mainline();

        expect((string) $type)->toBe('mainline');
    });
});
