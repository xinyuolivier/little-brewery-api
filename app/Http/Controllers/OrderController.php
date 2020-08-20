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
            $orders = json_decode($requests->orders, true);

            //dd($orders);
/*
            foreach($orders as $order => $data) {

                var_dump($name, $data['calID'], $data['availMsg']); // $name is the Name of Room
            }
            */

            foreach($orders as $order => $data){

                dd($order);
            }
            $order = Order::create([
                'bill' => $request->bill,
                'beer_id' => $request->beer_id,
                'user_id' => Auth::id(),
                'brewery_id' => $request->brewery_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);

            return response()->json([
                'status' => (bool) $order,
                'data'   => $order,
                'message' => $order ? 'Order Created!' : 'Error Creating Order'
            ]);
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