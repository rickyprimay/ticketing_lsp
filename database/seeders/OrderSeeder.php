<?php

namespace Database\Seeders;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'user_id' => 2,
                'event_id' => 1,
                'order_date' => '2024-07-01 14:30:00',
                'total_price' => 1500000,
            ],
        ];

        $order_details = [
            [
                'order_id' => 1,
                'ticket_id' => 1,
                'quantity' => 2,
                'subtotal_price' => 500000,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        foreach ($order_details as $detail) {
            DetailOrder::create($detail);
        }
    }
}