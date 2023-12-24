<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'image', 'estimated_time', 'pricing', 'artisan_id'];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
