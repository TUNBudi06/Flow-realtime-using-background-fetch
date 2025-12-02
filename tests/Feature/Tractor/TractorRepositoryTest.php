<?php

use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;
use App\Infrastructure\Repositories\EloquentTractorRepository;

describe('EloquentTractorRepository', function () {
    beforeEach(function () {
        $this->repository = new EloquentTractorRepository;
    });

    it('saves and retrieves a tractor', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline(),
            alarmStatus: true
        );

        $savedTractor = $this->repository->save($tractor);

        expect($savedTractor->id())->not->toBeNull()
            ->and($savedTractor->number()->value())->toBe('6576')
            ->and($savedTractor->model()->value())->toBe('SF225GWZRE42S');

        $foundTractor = $this->repository->findById($savedTractor->id());

        expect($foundTractor)->not->toBeNull()
            ->and($foundTractor->number()->value())->toBe('6576');
    });

    it('finds tractor by model', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('1234'),
            model: TractorModel::create('UNIQUE_MODEL'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('Jane Doe', '87654321'),
            productionType: ProductionType::inspeksi(),
            alarmStatus: false
        );

        $this->repository->save($tractor);

        $foundTractor = $this->repository->findByModel(TractorModel::create('UNIQUE_MODEL'));

        expect($foundTractor)->not->toBeNull()
            ->and($foundTractor->number()->value())->toBe('1234');
    });

    it('returns null when tractor not found by id', function () {
        $foundTractor = $this->repository->findById(99999);

        expect($foundTractor)->toBeNull();
    });

    it('returns null when tractor not found by model', function () {
        $foundTractor = $this->repository->findByModel(TractorModel::create('NONEXISTENT'));

        expect($foundTractor)->toBeNull();
    });

    it('deletes a tractor', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('5678'),
            model: TractorModel::create('DELETE_MODEL'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('Delete User', '00000000'),
            productionType: ProductionType::delivery(),
            alarmStatus: true
        );

        $savedTractor = $this->repository->save($tractor);
        $tractorId = $savedTractor->id();

        $this->repository->delete($savedTractor);

        $foundTractor = $this->repository->findById($tractorId);

        expect($foundTractor)->toBeNull();
    });

    it('finds all tractors', function () {
        // Create multiple tractors
        for ($i = 1; $i <= 3; $i++) {
            $tractor = Tractor::create(
                number: TractorNumber::create((string) (1000 + $i)),
                model: TractorModel::create('MODEL_'.$i),
                description: 'Test description '.$i,
                imagePath: 'tractors/test'.$i.'.jpg',
                userInfo: UserInfo::create('User '.$i, 'NIK'.$i),
                productionType: ProductionType::mainline(),
                alarmStatus: true
            );
            $this->repository->save($tractor);
        }

        $allTractors = $this->repository->findAll();

        expect($allTractors)->toBeArray()
            ->and(count($allTractors))->toBeGreaterThanOrEqual(3);
    });

    it('finds tractors with active alarm', function () {
        // Create tractor with active alarm
        $activeTractor = Tractor::create(
            number: TractorNumber::create('9999'),
            model: TractorModel::create('ACTIVE_ALARM'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('Active User', '11111111'),
            productionType: ProductionType::mainline(),
            alarmStatus: true
        );
        $this->repository->save($activeTractor);

        // Create tractor without active alarm
        $inactiveTractor = Tractor::create(
            number: TractorNumber::create('8888'),
            model: TractorModel::create('INACTIVE_ALARM'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('Inactive User', '22222222'),
            productionType: ProductionType::mainline(),
            alarmStatus: false
        );
        $this->repository->save($inactiveTractor);

        $activeAlarmTractors = $this->repository->findWithActiveAlarm();

        $hasActiveTractor = false;
        foreach ($activeAlarmTractors as $tractor) {
            if ($tractor->model()->value() === 'ACTIVE_ALARM') {
                $hasActiveTractor = true;
            }
            expect($tractor->alarmStatus())->toBeTrue();
        }

        expect($hasActiveTractor)->toBeTrue();
    });

    it('updates an existing tractor', function () {
        $tractor = Tractor::create(
            number: TractorNumber::create('7777'),
            model: TractorModel::create('UPDATE_MODEL'),
            description: 'Original description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('Original User', '33333333'),
            productionType: ProductionType::mainline(),
            alarmStatus: true
        );

        $savedTractor = $this->repository->save($tractor);

        // Disable alarm
        $savedTractor->disableAlarm();
        $updatedTractor = $this->repository->save($savedTractor);

        expect($updatedTractor->alarmStatus())->toBeFalse();

        // Verify from database
        $foundTractor = $this->repository->findById($savedTractor->id());
        expect($foundTractor->alarmStatus())->toBeFalse();
    });
});
