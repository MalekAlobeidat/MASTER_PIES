<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'years_of_experience',
        'jerny',
        'formal_education',
        'apprenticeships',
        'association_memberships',
        'user_id',
       'specialty_id',
       'phone_number',
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'artisan_cities');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, Service::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Artisan_subscription::class);
    }
}
