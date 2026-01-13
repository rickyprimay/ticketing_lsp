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
                'event_id' => 4,
                'order_date' => '2024-07-01 14:30:00',
                'total_price' => 1500000,
            ],
            // [
            //     'user_id' => 2,
            //     'event_id' => 2,
            //     'order_date' => '2024-07-02 10:15:00',
            //     'total_price' => 200000,
            // ],
        ];

        $order_details = [
            [
                'order_id' => 3,
                'ticket_id' => 6,
                'amount' => 1,
                'price_amount' => 1500000,
            ],
            // [
            //     'order_id' => 2,
            //     'ticket_id' => 3,
            //     'amount' => 1,
            //     'price_amount' => 200000,
            // ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        foreach ($order_details as $detail) {
            DetailOrder::create($detail);
        }
    }
}