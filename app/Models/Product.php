<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany};

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the customer for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
