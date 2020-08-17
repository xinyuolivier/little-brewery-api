<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beer;

class BeerController extends Controller
{
    public function index()
        {
            return response()->json(Beer::all(),200);//à modifier chargement progressive
        }

        public function store(Request $request)
        {
            $beer = Beer::create([
                'name' => $request->name,
                'brewery_id' => $request->brewery_id,
                'description' => $request->description,
                'flavor' => $request->flavor,
                'color' => $request->color,
                'price' => $request->price,
                'packaging'=> $request->packaging,
                'quantity' => $request->quantity,
                'image' => $request->image
            ]);

            return response()->json([
                'status' => (bool) $beer,
                'data'   => $beer,
                'message' => $beer ? 'Beer Created!' : 'Error Creating Beer'
            ]);
        }

        public function show(Beer $beer)
        {
            return response()->json($beer,200); 
        }

        public function uploadFile(Request $request)
        {
            if($request->hasFile('image')){
                $name = time()."_".$request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('images'), $name);
            }
            return response()->json(asset("images/$name"),201);
        }

        public function update(Request $request, Beer $beer)
        {
            $status = $beer->update(
                $request->only(['name', 'brewery_id', 'description', 'flavor', 'packaging', 'color', 'price', 'quantity', 'image'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Beer Updated!' : 'Error Updating Beer'
            ]);
        }

        public function updateQuantity(Request $request, Beer $beer)
        {
            $beer->quantity = $beer->quantity + $request->get('quantity');
            $status = $beer->save();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Quantity Updated!' : 'Error Updating Product Quantity'
            ]);
        }


        public function destroy(Beer $beer)
        {
            $status = $beer->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Beer Deleted!' : 'Error Deleting Beer'
            ]);
        }
}
