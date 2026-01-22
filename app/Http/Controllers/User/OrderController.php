<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Tickets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('event')->orderBy('created_at', 'desc')->get();
        
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('detail_orders.tickets', 'event');
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'items' => 'required|array|min:1',
            'items.*.tiket_id' => 'required|integer|exists:tickets,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        try {
            $order = DB::transaction(function () use ($data, $user) {
                $total = 0;
                
                foreach ($data['items'] as $it) {
                    $t = Tickets::lockForUpdate()->findOrFail($it['tiket_id']);
                    if ($t->stock < $it['jumlah']) {
                        throw new \Exception("Stok tidak cukup untuk tipe: {$t->type}");
                    }
                    $total += ($t->price ?? 0) * $it['jumlah'];
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'event_id' => $data['event_id'],
                    'order_date' => Carbon::now(),
                    'total_price' => $total,
                ]);

                foreach ($data['items'] as $it) {
                    $t = Tickets::findOrFail($it['tiket_id']);
                    $subtotal = ($t->price ?? 0) * $it['jumlah'];
                    
                    DetailOrder::create([
                        'order_id' => $order->id,
                        'ticket_id' => $t->id,
                        'quantity' => $it['jumlah'],
                        'subtotal_price' => $subtotal,
                    ]);

                    $t->stock = max(0, $t->stock - $it['jumlah']);
                    $t->save();
                }

                return $order;
            });

            session()->flash('success', 'Pesanan berhasil dibuat.');

            return response()->json([
                'ok' => true,
                'order_id' => $order->id,
                'redirect' => route('orders.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
