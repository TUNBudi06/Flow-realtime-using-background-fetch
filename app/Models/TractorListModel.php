<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TractorListModel extends Model
{
    protected $table = 'tractor_list_models';

    protected $fillable = [
        'No',
        'Model',
        'Keterangan',
        'image',
        'name',
        'nik',
    ];
}
