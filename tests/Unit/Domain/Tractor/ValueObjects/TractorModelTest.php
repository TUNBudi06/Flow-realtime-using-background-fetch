<?php

use App\Domain\Tractor\ValueObjects\TractorModel;

describe('TractorModel', function () {
    it('creates a valid tractor model', function () {
        $model = TractorModel::create('SF225GWZRE42S');

        expect($model->value())->toBe('SF225GWZRE42S')
            ->and((string) $model)->toBe('SF225GWZRE42S');
    });

    it('trims whitespace from the value', function () {
        $model = TractorModel::create('  SF225GWZRE42S  ');

        expect($model->value())->toBe('SF225GWZRE42S');
    });

    it('throws exception for empty value', function () {
        TractorModel::create('');
    })->throws(InvalidArgumentException::class, 'Tractor model cannot be empty');

    it('throws exception for whitespace only value', function () {
        TractorModel::create('   ');
    })->throws(InvalidArgumentException::class, 'Tractor model cannot be empty');

    it('compares equality correctly', function () {
        $model1 = TractorModel::create('SF225GWZRE42S');
        $model2 = TractorModel::create('SF225GWZRE42S');
        $model3 = TractorModel::create('ABC123');

        expect($model1->equals($model2))->toBeTrue()
            ->and($model1->equals($model3))->toBeFalse();
    });
});
