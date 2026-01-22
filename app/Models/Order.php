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

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function detail_orders()
    {
        return $this->hasMany(DetailOrder::class, 'order_id');
    }
}
