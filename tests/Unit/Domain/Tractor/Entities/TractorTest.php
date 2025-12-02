<?php

use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;

describe('Tractor Entity', function () {
    it('creates a new tractor with correct values', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline(),
            alarmStatus: true
        );

        expect($tractor->id())->toBeNull()
            ->and($tractor->number()->value())->toBe('6576')
            ->and($tractor->model()->value())->toBe('SF225GWZRE42S')
            ->and($tractor->description())->toBe('Test description')
            ->and($tractor->imagePath())->toBe('tractors/test.jpg')
            ->and($tractor->userInfo()->name())->toBe('John Doe')
            ->and($tractor->userInfo()->nik())->toBe('12345678')
            ->and($tractor->productionType()->isMainline())->toBeTrue()
            ->and($tractor->alarmStatus())->toBeTrue();
    });

    it('creates a new tractor with default alarm status', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline()
        );

        expect($tractor->alarmStatus())->toBeTrue();
    });

    it('reconstitutes a tractor from stored data', function () {
        $createdAt = new DateTimeImmutable('2024-01-15 10:00:00');
        $updatedAt = new DateTimeImmutable('2024-01-15 11:00:00');

        $tractor = Tractor::reconstitute(
            id: 1,
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline(),
            alarmStatus: true,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );

        expect($tractor->id())->toBe(1)
            ->and($tractor->createdAt())->toBe($createdAt)
            ->and($tractor->updatedAt())->toBe($updatedAt);
    });

    it('disables alarm', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline(),
            alarmStatus: true
        );

        expect($tractor->alarmStatus())->toBeTrue();

        $tractor->disableAlarm();

        expect($tractor->alarmStatus())->toBeFalse();
    });

    it('enables alarm', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline(),
            alarmStatus: false
        );

        expect($tractor->alarmStatus())->toBeFalse();

        $tractor->enableAlarm();

        expect($tractor->alarmStatus())->toBeTrue();
    });

    it('generates description correctly', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: '',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline()
        );

        $description = $tractor->generateDescription();

        expect($description)->toBe('Tractor No 6576 dengan kode SF225GWZRE42S telah keluar dari Mainline');
    });

    it('generates description for different production types', function () {
        $inspeksiTractor = Tractor::create(
            number: TractorNumber::create('1234'),
            model: TractorModel::create('ABC123'),
            description: '',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::inspeksi()
        );

        $deliveryTractor = Tractor::create(
            number: TractorNumber::create('5678'),
            model: TractorModel::create('XYZ789'),
            description: '',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::delivery()
        );

        expect($inspeksiTractor->generateDescription())
            ->toBe('Tractor No 1234 dengan kode ABC123 telah keluar dari Inspeksi')
            ->and($deliveryTractor->generateDescription())
            ->toBe('Tractor No 5678 dengan kode XYZ789 telah keluar dari Delivery');
    });
});
