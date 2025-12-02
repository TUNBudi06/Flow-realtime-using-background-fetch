<?php

use App\Application\Tractor\Commands\DeleteTractorCommand;
use App\Application\Tractor\Handlers\DeleteTractorHandler;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;

describe('DeleteTractorHandler', function () {
    it('deletes an existing tractor', function () {
        $existingTractor = Tractor::reconstitute(
            id: 1,
            number: TractorNumber::create('6576'),
            model: TractorModel::create('SF225GWZRE42S'),
            description: 'Test description',
            imagePath: 'tractors/test.jpg',
            userInfo: UserInfo::create('John Doe', '12345678'),
            productionType: ProductionType::mainline(),
            alarmStatus: true,
            createdAt: new DateTimeImmutable,
            updatedAt: new DateTimeImmutable
        );

        $repository = Mockery::mock(TractorRepositoryInterface::class);

        $repository->shouldReceive('findByModel')
            ->once()
            ->andReturn($existingTractor);

        $repository->shouldReceive('delete')
            ->once()
            ->with($existingTractor);

        $handler = new DeleteTractorHandler($repository);

        $command = new DeleteTractorCommand(model: 'SF225GWZRE42S');

        $handler->handle($command);

        // If we get here without exception, test passed
        expect(true)->toBeTrue();
    });

    it('throws exception when tractor not found', function () {
        $repository = Mockery::mock(TractorRepositoryInterface::class);

        $repository->shouldReceive('findByModel')
            ->once()
            ->andReturn(null);

        $handler = new DeleteTractorHandler($repository);

        $command = new DeleteTractorCommand(model: 'NONEXISTENT');

        $handler->handle($command);
    })->throws(RuntimeException::class, 'Tractor not found');
});
