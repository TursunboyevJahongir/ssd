<?php

namespace App\Models;

use App\Enums\UsersGenderEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $full_name
 * @property string $first_name
 * @property string $last_name
 * @property integer $age
 * @property Carbon $date_birth
 * @property UsersGenderEnum $gender
 * @property UserAddress[] $addresses
 * @property Prisoner[] $prisoner
 */
class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_birth',
        'prisoner'
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
        'date_birth' => 'datetime',
        'prisoner' => 'boolean'
    ];

    public function getAgeAttribute(): int
    {
        $birth = $this->date_birth;

        return date_diff($birth, Carbon::now())->y;
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function prisoner(): HasMany
    {
        return $this->hasMany(Prisoner::class, 'user_id');
    }
}
