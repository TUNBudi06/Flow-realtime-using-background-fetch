<?php

declare(strict_types=1);

namespace App\Domain\Tractor\Entities;

use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;
use DateTimeImmutable;

final class Tractor
{
    private ?int $id;

    private TractorNumber $number;

    private TractorModel $model;

    private string $description;

    private string $imagePath;

    private UserInfo $userInfo;

    private ProductionType $productionType;

    private bool $alarmStatus;

    private DateTimeImmutable $createdAt;

    private DateTimeImmutable $updatedAt;

    private function __construct(
        ?int $id,
        TractorNumber $number,
        TractorModel $model,
        string $description,
        string $imagePath,
        UserInfo $userInfo,
        ProductionType $productionType,
        bool $alarmStatus,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->number = $number;
        $this->model = $model;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->userInfo = $userInfo;
        $this->productionType = $productionType;
        $this->alarmStatus = $alarmStatus;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        TractorNumber $number,
        TractorModel $model,
        string $description,
        string $imagePath,
        UserInfo $userInfo,
        ProductionType $productionType,
        bool $alarmStatus = true
    ): self {
        $now = new DateTimeImmutable;

        return new self(
            id: null,
            number: $number,
            model: $model,
            description: $description,
            imagePath: $imagePath,
            userInfo: $userInfo,
            productionType: $productionType,
            alarmStatus: $alarmStatus,
            createdAt: $now,
            updatedAt: $now
        );
    }

    public static function reconstitute(
        int $id,
        TractorNumber $number,
        TractorModel $model,
        string $description,
        string $imagePath,
        UserInfo $userInfo,
        ProductionType $productionType,
        bool $alarmStatus,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ): self {
        return new self(
            id: $id,
            number: $number,
            model: $model,
            description: $description,
            imagePath: $imagePath,
            userInfo: $userInfo,
            productionType: $productionType,
            alarmStatus: $alarmStatus,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function number(): TractorNumber
    {
        return $this->number;
    }

    public function model(): TractorModel
    {
        return $this->model;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function imagePath(): string
    {
        return $this->imagePath;
    }

    public function userInfo(): UserInfo
    {
        return $this->userInfo;
    }

    public function productionType(): ProductionType
    {
        return $this->productionType;
    }

    public function alarmStatus(): bool
    {
        return $this->alarmStatus;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function disableAlarm(): void
    {
        $this->alarmStatus = false;
        $this->updatedAt = new DateTimeImmutable;
    }

    public function enableAlarm(): void
    {
        $this->alarmStatus = true;
        $this->updatedAt = new DateTimeImmutable;
    }

    public function generateDescription(): string
    {
        return sprintf(
            'Tractor No %s dengan kode %s telah keluar dari %s',
            $this->number->value(),
            $this->model->value(),
            $this->productionType->displayName()
        );
    }
}
