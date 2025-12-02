<?php

declare(strict_types=1);

namespace App\Application\Tractor\Commands;

final readonly class DisableAlarmCommand
{
    public function __construct(
        public int $tractorId
    ) {}
}
