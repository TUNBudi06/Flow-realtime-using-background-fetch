<?php

declare(strict_types=1);

namespace App\Domain\Tractor\Repositories;

use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\ValueObjects\TractorModel;

interface TractorRepositoryInterface
{
    public function save(Tractor $tractor): Tractor;

    public function findById(int $id): ?Tractor;

    public function findByModel(TractorModel $model): ?Tractor;

    public function delete(Tractor $tractor): void;

    /**
     * @return Tractor[]
     */
    public function findAll(): array;

    /**
     * @return Tractor[]
     */
    public function findWithActiveAlarm(): array;
}
