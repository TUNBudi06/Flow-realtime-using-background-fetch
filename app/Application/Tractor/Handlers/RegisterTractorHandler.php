<?php

declare(strict_types=1);

namespace App\Application\Tractor\Handlers;

use App\Application\Tractor\Commands\RegisterTractorCommand;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;

final readonly class RegisterTractorHandler
{
    public function __construct(
        private TractorRepositoryInterface $repository
    ) {}

    public function handle(RegisterTractorCommand $command): Tractor
    {
        $tractor = Tractor::create(
            number: TractorNumber::create($command->number),
            model: TractorModel::create($command->model),
            description: '',
            imagePath: $command->imagePath,
            userInfo: UserInfo::create($command->userName, $command->userNik),
            productionType: ProductionType::fromString($command->productionType),
            alarmStatus: true
        );

        // Generate description after entity is created
        $description = $tractor->generateDescription();

        // Create new tractor with description
        $tractorWithDescription = Tractor::create(
            number: TractorNumber::create($command->number),
            model: TractorModel::create($command->model),
            description: $description,
            imagePath: $command->imagePath,
            userInfo: UserInfo::create($command->userName, $command->userNik),
            productionType: ProductionType::fromString($command->productionType),
            alarmStatus: true
        );

        return $this->repository->save($tractorWithDescription);
    }
}
