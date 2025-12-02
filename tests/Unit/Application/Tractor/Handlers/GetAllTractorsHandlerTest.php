<?php

use App\Application\Tractor\Handlers\GetAllTractorsHandler;
use App\Application\Tractor\Queries\GetAllTractorsQuery;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;

describe('GetAllTractorsHandler', function () {
    it('returns all tractors', function () {
        $tractors = [
            Tractor::reconstitute(
                id: 1,
                number: TractorNumber::create('6576'),
                model: TractorModel::create('SF225GWZRE42S'),
                description: 'Test description 1',
                imagePath: 'tractors/test1.jpg',
                userInfo: UserInfo::create('John Doe', '12345678'),
                productionType: ProductionType::mainline(),
                alarmStatus: true,
                createdAt: new DateTimeImmutable,
                updatedAt: new DateTimeImmutable
            ),
            Tractor::reconstitute(
                id: 2,
                number: TractorNumber::create('1234'),
                model: TractorModel::create('ABC123'),
                description: 'Test description 2',
                imagePath: 'tractors/test2.jpg',
                userInfo: UserInfo::create('Jane Doe', '87654321'),
                productionType: ProductionType::inspeksi(),
                alarmStatus: false,
                createdAt: new DateTimeImmutable,
                updatedAt: new DateTimeImmutable
            ),
        ];

        $repository = Mockery::mock(TractorRepositoryInterface::class);
        $repository->shouldReceive('findAll')->once()->andReturn($tractors);

        $handler = new GetAllTractorsHandler($repository);

        $result = $handler->handle(new GetAllTractorsQuery);

        expect($result)->toHaveCount(2)
            ->and($result[0]->id())->toBe(1)
            ->and($result[1]->id())->toBe(2);
    });

    it('returns empty array when no tractors exist', function () {
        $repository = Mockery::mock(TractorRepositoryInterface::class);
        $repository->shouldReceive('findAll')->once()->andReturn([]);

        $handler = new GetAllTractorsHandler($repository);

        $result = $handler->handle(new GetAllTractorsQuery);

        expect($result)->toBeArray()->toHaveCount(0);
    });
});
