<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $creator
 */
class Chirp extends Model
{
    /** @use HasFactory<\Database\Factories\ChirpFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'message',
    ];

    /**
     * User who created this Chirp.
     *
     * @return BelongsTo<User, $this>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
