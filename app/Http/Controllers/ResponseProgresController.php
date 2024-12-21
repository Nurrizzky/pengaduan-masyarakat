<?php

namespace App\Http\Controllers;

use App\Models\ResponseProgres;
use Illuminate\Http\Request;

class ResponseProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'followUp' => 'required|string|max:258',
        ]);
        
        ResponseProgres::create([
            'response_id' => $id,
            'histories' => json_encode([$request->followUp]), // Data dalam format JSON
        ]);
        
        return redirect()->back()->with('success', 'Berhasil membuat tanggapan.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(ResponseProgres $responseProgres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResponseProgres $responseProgres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResponseProgres $responseProgres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResponseProgres $responseProgres)
    {
        //
    }
}
