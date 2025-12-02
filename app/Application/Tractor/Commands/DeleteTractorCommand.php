<?php

declare(strict_types=1);

namespace App\Application\Tractor\Commands;

final readonly class DeleteTractorCommand
{
    public function __construct(
        public string $model
    ) {}
}
