<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.forms.pengeluaran');
    }

    public function index2()
    {
        return view('layouts.forms.pengeluaranKegiatan');
    }

    public function index3()
    {
        return view('layouts.forms.pengeluaranOpsional');
    }

    public function index4()
    {
        return view('layouts.forms.pengeluaranPembangunan');
    }

    public function index5()
    {
        return view('layouts.forms.kategoriPengeluaran');
    }

    public function index6()
    {
        return view('layouts.forms.kategoriPengeluaran2');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

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
