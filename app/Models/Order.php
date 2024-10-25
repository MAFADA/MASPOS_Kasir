<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['UID', 'total'];

    /**
     * Get all of the comments for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
}
