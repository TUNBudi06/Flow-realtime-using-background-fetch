<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Tractor\Entities\Tractor;
use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Domain\Tractor\ValueObjects\ProductionType;
use App\Domain\Tractor\ValueObjects\TractorModel;
use App\Domain\Tractor\ValueObjects\TractorNumber;
use App\Domain\Tractor\ValueObjects\UserInfo;
use App\Models\TractorListModel;
use DateTimeImmutable;

final class EloquentTractorRepository implements TractorRepositoryInterface
{
    public function save(Tractor $tractor): Tractor
    {
        $model = $tractor->id() !== null
            ? TractorListModel::find($tractor->id())
            : new TractorListModel;

        if ($model === null) {
            $model = new TractorListModel;
        }

        $model->fill([
            'No' => $tractor->number()->value(),
            'Model' => $tractor->model()->value(),
            'Keterangan' => $tractor->description(),
            'image' => $tractor->imagePath(),
            'name' => $tractor->userInfo()->name(),
            'nik' => $tractor->userInfo()->nik(),
            'prod_type' => $tractor->productionType()->value(),
            'alarm_status' => $tractor->alarmStatus(),
        ]);

        $model->save();

        return $this->mapToDomain($model);
    }

    public function findById(int $id): ?Tractor
    {
        $model = TractorListModel::find($id);

        return $model !== null ? $this->mapToDomain($model) : null;
    }

    public function findByModel(TractorModel $model): ?Tractor
    {
        $tractorModel = TractorListModel::where('Model', $model->value())->first();

        return $tractorModel !== null ? $this->mapToDomain($tractorModel) : null;
    }

    public function delete(Tractor $tractor): void
    {
        if ($tractor->id() !== null) {
            TractorListModel::destroy($tractor->id());

            return;
        }

        TractorListModel::where('Model', $tractor->model()->value())->delete();
    }

    /**
     * @return Tractor[]
     */
    public function findAll(): array
    {
        $models = TractorListModel::orderBy('created_at', 'desc')->get();

        return $models->map(fn (TractorListModel $model) => $this->mapToDomain($model))->toArray();
    }

    /**
     * @return Tractor[]
     */
    public function findWithActiveAlarm(): array
    {
        $models = TractorListModel::where('alarm_status', true)->get();

        return $models->map(fn (TractorListModel $model) => $this->mapToDomain($model))->toArray();
    }

    private function mapToDomain(TractorListModel $model): Tractor
    {
        return Tractor::reconstitute(
            id: $model->id,
            number: TractorNumber::create((string) $model->No),
            model: TractorModel::create($model->Model),
            description: $model->Keterangan,
            imagePath: $model->image,
            userInfo: UserInfo::create($model->name, $model->nik),
            productionType: ProductionType::fromString($model->prod_type),
            alarmStatus: (bool) $model->alarm_status,
            createdAt: new DateTimeImmutable($model->created_at->toDateTimeString()),
            updatedAt: new DateTimeImmutable($model->updated_at->toDateTimeString())
        );
    }
}
