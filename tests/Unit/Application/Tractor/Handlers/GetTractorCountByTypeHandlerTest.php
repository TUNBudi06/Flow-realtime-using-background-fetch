<?php

use App\Application\Tractor\Handlers\GetTractorCountByTypeHandler;
use App\Application\Tractor\Queries\GetTractorCountByTypeQuery;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;

describe('GetTractorCountByTypeHandler', function () {
    it('returns correct counts for each production type', function () {
        $tractors = [
            Tractor::reconstitute(
                id: 1,
                number: TractorNumber::create('1111'),
                model: TractorModel::create('MODEL1'),
                description: 'Test',
                imagePath: 'tractors/test.jpg',
                userInfo: UserInfo::create('John', '123'),
                productionType: ProductionType::mainline(),
                alarmStatus: true,
                createdAt: new DateTimeImmutable,
                updatedAt: new DateTimeImmutable
            ),
            Tractor::reconstitute(
                id: 2,
                number: TractorNumber::create('2222'),
                model: TractorModel::create('MODEL2'),
                description: 'Test',
                imagePath: 'tractors/test.jpg',
                userInfo: UserInfo::create('Jane', '456'),
                productionType: ProductionType::mainline(),
                alarmStatus: true,
                createdAt: new DateTimeImmutable,
                updatedAt: new DateTimeImmutable
            ),
            Tractor::reconstitute(
                id: 3,
                number: TractorNumber::create('3333'),
                model: TractorModel::create('MODEL3'),
                description: 'Test',
                imagePath: 'tractors/test.jpg',
                userInfo: UserInfo::create('Bob', '789'),
                productionType: ProductionType::inspeksi(),
                alarmStatus: false,
                createdAt: new DateTimeImmutable,
                updatedAt: new DateTimeImmutable
            ),
            Tractor::reconstitute(
                id: 4,
                number: TractorNumber::create('4444'),
                model: TractorModel::create('MODEL4'),
                description: 'Test',
                imagePath: 'tractors/test.jpg',
                userInfo: UserInfo::create('Alice', '012'),
                productionType: ProductionType::delivery(),
                alarmStatus: false,
                createdAt: new DateTimeImmutable,
                updatedAt: new DateTimeImmutable
            ),
        ];

        $repository = Mockery::mock(TractorRepositoryInterface::class);
        $repository->shouldReceive('findAll')->once()->andReturn($tractors);

        $handler = new GetTractorCountByTypeHandler($repository);

        $result = $handler->handle(new GetTractorCountByTypeQuery);

        expect($result)->toBeArray()
            ->and($result['mainline'])->toBe(2)
            ->and($result['inspeksi'])->toBe(1)
            ->and($result['delivery'])->toBe(1);
    });

    it('returns zeros when no tractors exist', function () {
        $repository = Mockery::mock(TractorRepositoryInterface::class);
        $repository->shouldReceive('findAll')->once()->andReturn([]);

        $handler = new GetTractorCountByTypeHandler($repository);

        $result = $handler->handle(new GetTractorCountByTypeQuery);

        expect($result)->toBeArray()
            ->and($result['mainline'])->toBe(0)
            ->and($result['inspeksi'])->toBe(0)
            ->and($result['delivery'])->toBe(0);
    });
});
