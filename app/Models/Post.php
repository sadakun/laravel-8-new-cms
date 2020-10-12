<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #example using mutator for image path
    /* public function setPostImageAttribute($value)
        {
            $this->attributes['post_image'] = asset($value);
    }*/

    #example using accessor for image path
    /*public function getPostImage($value)
    {
        return asset($value);
    }*/

    #accessor image path if our dir is in local path or http
    public function getPostImageAttribute($value)
    {
        if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE)
            {
                return $value;
            }
        return asset('storage/' . $value);
    }
}
