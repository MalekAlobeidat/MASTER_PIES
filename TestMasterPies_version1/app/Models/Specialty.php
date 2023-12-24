<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;
    protected $fillable = ['name'];

    public function artisans()
    {
        return $this->hasMany(Artisan::class);
    }
}
