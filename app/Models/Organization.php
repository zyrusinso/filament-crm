<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory;
    use softDeletes;

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

    public function scopeAccount(Builder $builder)
    {
        return $builder->whereBelongsTo(auth()->user(), 'account' );
    }
}
