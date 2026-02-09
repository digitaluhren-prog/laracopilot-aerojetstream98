<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function userListings()
    {
        return $this->hasMany(UserListing::class);
    }
}