<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'postal_code',
        'prefecture',
        'city',
        'street',
        'building',
        'phone_number',
        'is_default'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
}