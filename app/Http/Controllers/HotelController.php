<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hoteis = Hotel::all();
        return view('hoteis.index', compact('hoteis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hoteis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
        ]);

        Hotel::create($request->all());

        return redirect()
            ->route('hoteis.index')
            ->with('success', 'Hotel criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
