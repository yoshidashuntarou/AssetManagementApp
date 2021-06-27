<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_asset_id',
        'registered_person_id',
        'administrator',
        'place',
        'asset_code',
        'asset_name',
        'acquisition_date',
        'model',
        'number_of_assets',
        'operational_verification',
    ];
}
