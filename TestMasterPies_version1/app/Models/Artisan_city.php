<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan_city extends Model
{
    use HasFactory;
    protected $fillable = ['artisan_id', 'city_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
