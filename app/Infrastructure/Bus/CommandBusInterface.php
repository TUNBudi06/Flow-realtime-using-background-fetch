<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

interface CommandBusInterface
{
    /**
     * @template T
     *
     * @return T|null
     */
    public function dispatch(object $command): mixed;
}
