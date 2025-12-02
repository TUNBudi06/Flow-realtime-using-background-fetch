<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

interface QueryBusInterface
{
    /**
     * @template T
     *
     * @return T
     */
    public function ask(object $query): mixed;
}
