<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Inertia\Response;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Inertia\ResponseFactory;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller {

    public function index(): Response|ResponseFactory {
        return inertia('Admin/Order', [

            'orders' => Order::orderByDesc('updated_at')
                ->get()
                ->map(function ($order) {
                    $json = json_decode($order['cart'], true);
                    $cart = [];
                    $fullPrice = 0;
                    $totalAmount = 0;

                    foreach ($json as $item) {
                        $menuItem = MenuItem::findOrNew($item['id']);
                        $amount = $item['amount'];
                        $totalAmount += $amount;
                        $fullPrice += $menuItem['price'] * $amount;

                        $cart[] = [
                            'item' => $menuItem,
                            'amount' => $amount,
                        ];
                    }

                    $order['totalAmount'] = $totalAmount;
                    $order['fullPrice'] = $fullPrice;
                    $order['cart'] = $cart;

                    return $order;
                }),

        ]);
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'address'       => ['string'],
            'name'          => ['string'],
            'phone'         => ['required', 'string'],
            'email'         => ['email'],
            'wishes'        => ['max:1024'],
            'isCompleted'   => ['bool'],
            'cart'          => ['required', 'min:1'],
            'cart.*.amount' => ['required', 'int'],
            'cart.*.id'     => ['required', 'int'],
        ]);
        $input = $request->input();
        $date = $input['selectedDate'];
        if (isset($date)) {
            $date = Carbon::parse($date)->format('Y-m-d H:i:s');
        }

        $order = Order::create([
            'selectedDate' => $date,
            'address'      => $input['address'],
            'name'         => $input['name'],
            'phone'        => $input['phone'],
            'email'        => $input['email'],
            'wishes'       => $input['wishes'],
            'isCompleted'  => $input['isCompleted'] ?? false,
            'cart'         => json_encode($input['cart']),
        ]);

        return to_route('rest.menu.index')->with('order', $order);
    }

    public function complete(Request $request): RedirectResponse {
        $request->validate([
            'id' => ['required', 'int'],
            'isCompleted' => ['required', 'bool']
        ]);
        $input = $request->input();
        $order = Order::findOrFail($input['id']);
        $order->isCompleted = $input['isCompleted'];
        $order->save();

        return to_route('admin.order.list')->with('success', 'Завершение заказа');
    }

    public function destroy(int $id): RedirectResponse {
        Order::destroy($id);
        session()->forget('order');

        return to_route('rest.menu.index')->with('success', 'Отмена заказа выполнена');
    }
}
