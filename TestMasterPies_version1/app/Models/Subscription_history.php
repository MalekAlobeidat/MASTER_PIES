<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription_history extends Model
{
    use HasFactory;
    protected $fillable = ['subscription_id', 'artisan_id'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }
}
