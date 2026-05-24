<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::latest()->get();;
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $places = place::all();
        return view('places.create', compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
      
        Place::create($request->all());
        return redirect()->route('places.index')
            ->with('success', 'Hotel criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $place::create($request->all());
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return redirect()->back();
    }
}
