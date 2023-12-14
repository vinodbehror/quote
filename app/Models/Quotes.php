<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotes extends Model
{
    use HasFactory;

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agents::class);
    }
}
