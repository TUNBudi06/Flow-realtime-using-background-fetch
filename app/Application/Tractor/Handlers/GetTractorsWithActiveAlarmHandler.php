<?php

declare(strict_types=1);

namespace App\Application\Tractor\Handlers;

use App\Application\Tractor\Queries\GetTractorsWithActiveAlarmQuery;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;

final readonly class GetTractorsWithActiveAlarmHandler
{
    public function __construct(
        private TractorRepositoryInterface $repository
    ) {}

    /**
     * @return Tractor[]
     */
    public function handle(GetTractorsWithActiveAlarmQuery $query): array
    {
        return $this->repository->findWithActiveAlarm();
    }
}
