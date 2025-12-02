<?php

declare(strict_types=1);

namespace App\Application\Tractor\Handlers;

use App\Application\Tractor\Queries\GetTractorCountByTypeQuery;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\ProductionType;

final readonly class GetTractorCountByTypeHandler
{
    public function __construct(
        private TractorRepositoryInterface $repository
    ) {}

    /**
     * @return array{mainline: int, delivery: int, inspeksi: int}
     */
    public function handle(GetTractorCountByTypeQuery $query): array
    {
        $tractors = $this->repository->findAll();

        $counts = [
            ProductionType::MAINLINE => 0,
            ProductionType::DELIVERY => 0,
            ProductionType::INSPEKSI => 0,
        ];

        foreach ($tractors as $tractor) {
            $type = $tractor->productionType()->value();
            if (isset($counts[$type])) {
                $counts[$type]++;
            }
        }

        return $counts;
    }
}
