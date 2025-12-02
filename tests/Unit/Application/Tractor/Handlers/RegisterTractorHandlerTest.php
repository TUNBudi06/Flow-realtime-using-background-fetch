<?php

use App\Application\Tractor\Commands\RegisterTractorCommand;
use App\Application\Tractor\Handlers\RegisterTractorHandler;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;

describe('RegisterTractorHandler', function () {
    it('registers a new tractor successfully', function () {
        // Create mock repository
        $repository = Mockery::mock(TractorRepositoryInterface::class);

        // Set up expectation
        $repository->shouldReceive('save')
            ->once()
            ->andReturnUsing(function (Tractor $tractor) {
                return Tractor::reconstitute(
                    id: 1,
                    number: $tractor->number(),
                    model: $tractor->model(),
                    description: $tractor->description(),
                    imagePath: $tractor->imagePath(),
                    userInfo: $tractor->userInfo(),
                    productionType: $tractor->productionType(),
                    alarmStatus: $tractor->alarmStatus(),
                    createdAt: $tractor->createdAt(),
                    updatedAt: $tractor->updatedAt()
                );
            });

        $handler = new RegisterTractorHandler($repository);

        $command = new RegisterTractorCommand(
            number: '6576',
            model: 'SF225GWZRE42S',
            imagePath: 'tractors/test.jpg',
            userName: 'John Doe',
            userNik: '12345678',
            productionType: 'mainline'
        );

        $result = $handler->handle($command);

        expect($result)->toBeInstanceOf(Tractor::class)
            ->and($result->id())->toBe(1)
            ->and($result->number()->value())->toBe('6576')
            ->and($result->model()->value())->toBe('SF225GWZRE42S')
            ->and($result->userInfo()->name())->toBe('John Doe')
            ->and($result->alarmStatus())->toBeTrue()
            ->and($result->description())->toContain('Tractor No 6576');
    });

    it('generates correct description for different production types', function () {
        $repository = Mockery::mock(TractorRepositoryInterface::class);

        $repository->shouldReceive('save')
            ->andReturnUsing(function (Tractor $tractor) {
                return Tractor::reconstitute(
                    id: 1,
                    number: $tractor->number(),
                    model: $tractor->model(),
                    description: $tractor->description(),
                    imagePath: $tractor->imagePath(),
                    userInfo: $tractor->userInfo(),
                    productionType: $tractor->productionType(),
                    alarmStatus: $tractor->alarmStatus(),
                    createdAt: $tractor->createdAt(),
                    updatedAt: $tractor->updatedAt()
                );
            });

        $handler = new RegisterTractorHandler($repository);

        $mainlineCommand = new RegisterTractorCommand(
            number: '6576',
            model: 'SF225GWZRE42S',
            imagePath: 'tractors/test.jpg',
            userName: 'John Doe',
            userNik: '12345678',
            productionType: 'mainline'
        );

        $inspeksiCommand = new RegisterTractorCommand(
            number: '1234',
            model: 'ABC123',
            imagePath: 'tractors/test.jpg',
            userName: 'Jane Doe',
            userNik: '87654321',
            productionType: 'inspeksi'
        );

        $mainlineResult = $handler->handle($mainlineCommand);
        $inspeksiResult = $handler->handle($inspeksiCommand);

        expect($mainlineResult->description())->toContain('Mainline')
            ->and($inspeksiResult->description())->toContain('Inspeksi');
    });
});
