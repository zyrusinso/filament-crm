<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(
            Account::class,
            'account_id'
        );
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'organization_id');
    }
}
