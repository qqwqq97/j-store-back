<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
      'user_id',
      'shipping_zip',
      'shipping_address1',
      'shipping_address2',
      'shipping_phone',
      'total_amount',
      'payment_intent_id',
      'order_status',
      'shipping_status'
    ];

    public function items()
    {
      return $this->hasMany(OrderItem::class);
    }
}