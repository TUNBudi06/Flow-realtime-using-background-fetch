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
        $number = TractorNumber::create($command->number);
        $model = TractorModel::create($command->model);
        $productionType = ProductionType::fromString($command->productionType);

        // Generate description from parameters
        $description = Tractor::buildDescription($number, $model, $productionType);

        $tractor = Tractor::create(
            number: $number,
            model: $model,
            description: $description,
            imagePath: $command->imagePath,
            userInfo: UserInfo::create($command->userName, $command->userNik),
            productionType: $productionType,
            alarmStatus: true
        );

        return $this->repository->save($tractor);
    }
}
