<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'artisan_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }
}
