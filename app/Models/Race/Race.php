<?php

namespace App\Models\Race;

use App\Models\User\Statistic as UserStatistic;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_start',
        'data_end',
        'laps',
        'difficulty',
        'local',
        'number_runners',
        'status',
    ];

    public function runners(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function stats(): HasOne
    {
        return $this->hasOne(Statistic::class);
    }

    public function runners_stats(): HasMany
    {
        return $this->hasMany(RunnerStatistic::class);
    }

}
