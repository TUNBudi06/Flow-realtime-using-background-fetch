<?php

declare(strict_types=1);

namespace App\Application\Tractor\Handlers;

use App\Application\Tractor\Commands\DisableAlarmCommand;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use RuntimeException;

final readonly class DisableAlarmHandler
{
    public function __construct(
        private TractorRepositoryInterface $repository
    ) {}

    public function handle(DisableAlarmCommand $command): void
    {
        $tractor = $this->repository->findById($command->tractorId);

        if ($tractor === null) {
            throw new RuntimeException('Tractor not found');
        }

        $tractor->disableAlarm();
        $this->repository->save($tractor);
    }
}
