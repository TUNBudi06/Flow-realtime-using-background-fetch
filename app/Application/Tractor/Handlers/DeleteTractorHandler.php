<?php

declare(strict_types=1);

namespace App\Application\Tractor\Handlers;

use App\Application\Tractor\Commands\DeleteTractorCommand;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\TractorModel;
use RuntimeException;

final readonly class DeleteTractorHandler
{
    public function __construct(
        private TractorRepositoryInterface $repository
    ) {}

    public function handle(DeleteTractorCommand $command): void
    {
        $tractor = $this->repository->findByModel(TractorModel::create($command->model));

        if ($tractor === null) {
            throw new RuntimeException('Tractor not found');
        }

        $this->repository->delete($tractor);
    }
}
