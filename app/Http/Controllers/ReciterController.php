<?php

namespace App\Http\Controllers;

use App\Models\Reciter;
use Illuminate\Http\Request;

class ReciterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Reciter/Index', [
            'reciters' => fn() => Reciter::query()->orderBy('name', 'asc')->get(),
        ]);
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
    public function show(Reciter $reciter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reciter $reciter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reciter $reciter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reciter $reciter)
    {
        //
    }
}
