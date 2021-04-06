<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected array $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function district(): HasMany
    {
        return $this->hasMany(District::class, 'region_id');
    }

    /**
     * @return HasMany
     */
    public function address(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'region_id');
    }
}
