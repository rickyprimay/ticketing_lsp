<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'total_price' => 'decimal:2',
        'order_date' => 'datetime',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(Tickets::class, 'detail_orders')
            ->withPivot('amount', 'price_amount');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
