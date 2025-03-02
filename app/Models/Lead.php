<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Lead extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the project for the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all of the customer for the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
