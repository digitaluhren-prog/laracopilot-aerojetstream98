<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserListing extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'city',
        'phone',
        'email',
        'price',
        'images',
        'status',
        'admin_notes'
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'images' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getFirstImageAttribute()
    {
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }
        return null;
    }
    
    public function getAllImagesAttribute()
    {
        if ($this->images && is_array($this->images)) {
            return array_map(function($image) {
                return asset('storage/' . $image);
            }, $this->images);
        }
        return [];
    }
}