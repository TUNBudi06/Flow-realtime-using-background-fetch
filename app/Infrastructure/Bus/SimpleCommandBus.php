<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Tractor\Commands\DeleteTractorCommand;
use App\Application\Tractor\Commands\DisableAlarmCommand;
use App\Application\Tractor\Commands\RegisterTractorCommand;
use App\Application\Tractor\Handlers\DeleteTractorHandler;
use App\Application\Tractor\Handlers\DisableAlarmHandler;
use App\Application\Tractor\Handlers\RegisterTractorHandler;
use InvalidArgumentException;

final readonly class SimpleCommandBus implements CommandBusInterface
{
    public function __construct(
        private RegisterTractorHandler $registerTractorHandler,
        private DeleteTractorHandler $deleteTractorHandler,
        private DisableAlarmHandler $disableAlarmHandler
    ) {}

    public function dispatch(object $command): mixed
    {
        return match ($command::class) {
            RegisterTractorCommand::class => $this->registerTractorHandler->handle($command),
            DeleteTractorCommand::class => $this->deleteTractorHandler->handle($command),
            DisableAlarmCommand::class => $this->disableAlarmHandler->handle($command),
            default => throw new InvalidArgumentException(
                sprintf('No handler found for command: %s', $command::class)
            ),
        };
    }
}
