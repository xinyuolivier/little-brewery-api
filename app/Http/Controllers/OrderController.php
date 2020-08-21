<?php

namespace App\Http\Controllers;

    use App\Order;
    use Auth;
    use Illuminate\Http\Request;

    class OrderController extends Controller
    {
        public function index()
        {
            return response()->json(Order::with(['beer'])->get(),200);
        }

        public function deliverOrder(Order $order)
        {
            $order->delivered = true;
            $status = $order->save();

            return response()->json([
                'status'    => $status,
                'data'      => $order,
                'message'   => $status ? 'Order Delivered!' : 'Error Delivering Order'
            ]);
        }

        public function store(Request $requests)
        {
            $orders = $requests->orders;

            $responseArr = [];
            foreach($orders as $order){
                if (gettype($order) == 'string'){
                    $order = json_decode($order, true);
                }

                $orderCreate = Order::create([
                    'bill' => (string)$order["bill"],
                    'beer_id' => (int) $order["beer_id"],
                    'user_id' => Auth::id(),
                    'brewery_id' => (int) $order["brewery_id"],
                    'quantity' => (int)$order["quantity"],
                    'price' => (double)$order["price"],
                    ]);

                $orderCreate->beer->quantity = $orderCreate->beer->quantity  - $orderCreate->quantity;
                $orderCreate->beer->save();

                array_push($responseArr, [
                        'status' => (bool) $orderCreate,
                        'data'   => $orderCreate,
                        'message' => $orderCreate ? 'Order Created!' : 'Error Creating Order'
                ]);
                
                
            }


            return response()->json($responseArr,200);
        }

        public function show(Order $order)
        {
            return response()->json($order,200);
        }

        public function update(Request $request, Order $order)
        {
            $status = $order->update(
                $request->only(['quantity'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Updated!' : 'Error Updating Order'
            ]);
        }

        public function destroy(Order $order)
        {
            $status = $order->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
            ]);
        }

    }