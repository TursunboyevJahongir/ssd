<?php

namespace App\Models;

use App\Enums\IncomeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Income
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property integer $price
 * @property IncomeEnum $type
 */
class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
