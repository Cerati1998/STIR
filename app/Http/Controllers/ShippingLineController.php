<?php

namespace App\Http\Controllers;

use App\Models\ShippingLine;
use Illuminate\Http\Request;

class ShippingLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masters.lines.index');
    }

    public function vessels($id)
    {
        $shipping_line = ShippingLine::findOrFail($id);
        return view('masters.lines.vessels', compact('shipping_line'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingLine $shippingLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingLine $shippingLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingLine $shippingLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingLine $shippingLine)
    {
        //
    }
}
