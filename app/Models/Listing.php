<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'city',
        'address',
        'phone',
        'email',
        'website',
        'active',
        'featured',
        'views',
        'average_rating',
        'total_reviews'
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'views' => 'integer',
        'average_rating' => 'decimal:2',
        'total_reviews' => 'integer'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('approved', true);
    }
    
    public function incrementViews()
    {
        $this->increment('views');
    }
    
    public function updateRating()
    {
        $approvedReviews = $this->reviews()->where('approved', true)->get();
        $this->total_reviews = $approvedReviews->count();
        $this->average_rating = $approvedReviews->count() > 0 
            ? $approvedReviews->avg('rating') 
            : 0;
        $this->save();
    }
}