<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jasa = DB::table('tb_jasa')->get();
        return view('layouts.jasa', compact('jasa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.tambah_jasa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jasa' => 'required|string|max:100',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        DB::table('tb_jasa')->insert([
            'nama_jasa' => $validated['nama_jasa'],
            'harga_satuan' => $validated['harga_satuan'],
        ]);

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil ditambahkan!');
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
        // Fetch data based on ID
        $jasa = DB::table('tb_jasa')->where('id', $id)->first();

        if (!$jasa) {
            abort(404, 'Data tidak ditemukan');
        }

        return view('layouts.ubah_jasa', compact('jasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming inputs
        $request->validate([
            'nama_jasa' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
        ]);

        // Update the data in tb_jasa
        DB::table('tb_jasa')->where('id', $id)->update([
            'nama_jasa' => $request->nama_jasa,
            'harga_satuan' => $request->harga_satuan,
        ]);

        // Adjust '/jasa' to whatever your main list route URL is
        return redirect()->route('jasa.index')->with('success', 'Data jasa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('tb_jasa')->where('id', $id)->delete();
        return redirect()->route('jasa.index')->with('success', 'Data berhasil dihapus.');
    }
}
