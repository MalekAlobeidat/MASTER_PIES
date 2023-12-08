<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['duration', 'cost','name'];
   
    public function artisanSubscriptions()
    {
        return $this->hasMany(Artisan_subscription::class);
    }
}
