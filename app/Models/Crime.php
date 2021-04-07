<?php

namespace App\Models;

use App\Enums\UsersGenderEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Crime
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $imprisonment_regime
 * @property string $term
 * @property Carbon $end_of_term
 * @property Carbon $start_of_term
 * @property Law[] $laws
 */
class Crime extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'law_id',
        'prisoner_id',
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
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lows(){
        return $this->belongsToMany(Law::class)->withTrashed();
    }
}
