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
class Cost extends Model
{
    use HasFactory;

    protected array $fillable = [
        'name',
        'price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected array $casts = [
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
