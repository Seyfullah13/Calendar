<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyAttribute;



class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function import()
    {
        return view('themes.tailwind.properties.import');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('themes.tailwind.properties.create-property');
    }

    public function edit($id)
    {
        $property = Property::find($id);
        
        return view('themes.tailwind.properties.edit-property', compact('property'));
    }

    public function test($id)
    {
        $attribute = PropertyAttribute::find($id);

        return view('themes.tailwind.properties.edit-property-attribute', compact('attribute'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
