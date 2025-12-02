<?php

declare(strict_types=1);

namespace App\Application\Tractor\Handlers;

use App\Application\Tractor\Queries\GetAllTractorsQuery;
use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;

final readonly class GetAllTractorsHandler
{
    public function __construct(
        private TractorRepositoryInterface $repository
    ) {}

    /**
     * @return Tractor[]
     */
    public function handle(GetAllTractorsQuery $query): array
    {
        return $this->repository->findAll();
    }
}
