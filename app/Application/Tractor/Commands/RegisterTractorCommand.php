<?php

declare(strict_types=1);

namespace App\Application\Tractor\Commands;

final readonly class RegisterTractorCommand
{
    public function __construct(
        public string $number,
        public string $model,
        public string $imagePath,
        public string $userName,
        public string $userNik,
        public string $productionType
    ) {}
}
