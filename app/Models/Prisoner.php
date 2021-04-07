<?php

namespace App\Models;

use App\Enums\UsersGenderEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Str;

/**
 * Class Prisoner
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $imprisonment_regime
 * @property string $term
 * @property Carbon $end_of_term
 * @property Carbon $start_of_term
 * @property Law[] $laws
 * @property User $user
 */
class Prisoner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'user_id',
        'imprisonment_regime',
        'term',
        'start_of_term',
        'end_of_term',
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
        'end_of_term' => 'datetime',
        'start_of_term' => 'datetime',
    ];

    public function getImprisonmentRegimeShortAttribute()
    {
        return Str::limit($this->imprisonment_regime, 20);
    }

//    public function getEndOfTermAttribute()
//    {
//        return $this->attributes['end_of_term'] !== null ? $this->attributes['end_of_term'] : 'bir umirga';
//    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laws()
    {
        return $this->belongsToMany(Law::class, 'crimes')->withTrashed();
    }

    public function crimes()
    {
        return $this->hasMany(Crime::class);
    }
}
