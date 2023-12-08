<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan_subscription extends Model
{
    use HasFactory;
    protected $fillable = ['start_date', 'end_date', 'subscription_id', 'artisan_id'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }
}
