<?php

namespace Database\Seeders;

use App\Models\Tickets;
use App\Models\Tiket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            [
                'event_id' => 1,
                'type' => 'premium',
                'price' => 1500000,
                'stock' => 100,
            ],
            [
                'event_id' => 1,
                'type' => 'reguler',
                'price' => 500000,
                'stock' => 500,
            ],
            [
                'event_id' => 2,
                'type' => 'premium',
                'price' => 200000,
                'stock' => 300,
            ],
            [
                'event_id' => 3,
                'type' => 'premium',
                'price' => 300000,
                'stock' => 200,
            ],
        ];

        foreach ($tickets as $ticket) {
            Tickets::create($ticket);
        }
    }
}