<?php

use App\Domain\Tractor\ValueObjects\TractorNumber;

describe('TractorNumber', function () {
    it('creates a valid tractor number', function () {
        $number = TractorNumber::create('6576');

        expect($number->value())->toBe('6576')
            ->and((string) $number)->toBe('6576');
    });

    it('trims whitespace from the value', function () {
        $number = TractorNumber::create('  6576  ');

        expect($number->value())->toBe('6576');
    });

    it('throws exception for empty value', function () {
        TractorNumber::create('');
    })->throws(InvalidArgumentException::class, 'Tractor number cannot be empty');

    it('throws exception for whitespace only value', function () {
        TractorNumber::create('   ');
    })->throws(InvalidArgumentException::class, 'Tractor number cannot be empty');

    it('compares equality correctly', function () {
        $number1 = TractorNumber::create('6576');
        $number2 = TractorNumber::create('6576');
        $number3 = TractorNumber::create('1234');

        expect($number1->equals($number2))->toBeTrue()
            ->and($number1->equals($number3))->toBeFalse();
    });
});
