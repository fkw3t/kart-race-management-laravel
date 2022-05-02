<?php

namespace App\Models\Race;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'races_stats';
    protected $fillable = [
        'race_id',
        'stats',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }
}
