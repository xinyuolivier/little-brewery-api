<?php

namespace App\Http\Controllers;

use App\Brewery;
use Illuminate\Http\Request;

class BreweryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Brewery::all(),200); //à modifier chargement progressive
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brewery = Brewery::create([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'profile' => $request->profile,
        ]);

        return response()->json([
            'status' => (bool) $brewery,
            'data'   => $brewery,
            'message' => $brewery ? 'Brewery Created!' : 'Error Creating Brewery'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function show(Brewery $brewery)
    {
        return response()->json($brewery,200);
    }

    public function showBeers(Brewery $brewery)
    {
        return response()->json($brewery->beer()->get());
        //return response()->json($user->orders()->with(['beer'])->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brewery $brewery)
    {
        $status = $brewery->update(
            $request->only(['name', 'description', 'address', 'city', 'profile'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Brewery Updated!' : 'Error Updating Brewery'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brewery $brewery)
    {
        $status = $brewery->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Brewery Deleted!' : 'Error Deleting Brewery'
            ]);
    }
}
