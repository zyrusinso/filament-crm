<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Squire\Models\Country;

class Account extends Model
{
    use HasFactory;

    public function organizations()
    {
        return $this->hasMany(
            Organization::class,
            'account_id'
        );
    }
    public function users()
    {
        return $this->hasMany(
            User::class,
            'account_id'
        );
    }
    public function contacts()
    {
        return $this->hasMany(
            Contact::class,
            'account_id'
        );
    }

    public function countryName()
    {
        return $this->belongsTo(Country::class, 'country');
    }
}
