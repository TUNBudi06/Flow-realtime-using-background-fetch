<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Tractor\Handlers\GetAllTractorsHandler;
use App\Application\Tractor\Handlers\GetTractorCountByTypeHandler;
use App\Application\Tractor\Handlers\GetTractorsWithActiveAlarmHandler;
use App\Application\Tractor\Queries\GetAllTractorsQuery;
use App\Application\Tractor\Queries\GetTractorCountByTypeQuery;
use App\Application\Tractor\Queries\GetTractorsWithActiveAlarmQuery;
use InvalidArgumentException;

final readonly class SimpleQueryBus implements QueryBusInterface
{
    public function __construct(
        private GetAllTractorsHandler $getAllTractorsHandler,
        private GetTractorsWithActiveAlarmHandler $getTractorsWithActiveAlarmHandler,
        private GetTractorCountByTypeHandler $getTractorCountByTypeHandler
    ) {}

    public function ask(object $query): mixed
    {
        return match ($query::class) {
            GetAllTractorsQuery::class => $this->getAllTractorsHandler->handle($query),
            GetTractorsWithActiveAlarmQuery::class => $this->getTractorsWithActiveAlarmHandler->handle($query),
            GetTractorCountByTypeQuery::class => $this->getTractorCountByTypeHandler->handle($query),
            default => throw new InvalidArgumentException(
                sprintf('No handler found for query: %s', $query::class)
            ),
        };
    }
}
