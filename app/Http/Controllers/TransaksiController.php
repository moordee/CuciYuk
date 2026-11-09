<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = DB::table('tb_transaksi')
            ->leftJoin('tb_jasa', 'tb_transaksi.jenis_jasa', '=', 'tb_jasa.id')
            ->select('tb_transaksi.*', 'tb_jasa.nama_jasa')
            ->get();

        return view('layouts.transaksi', compact('transaksi'));
    }

    public function cetak(string $id)
    {
        $transaksi = DB::table('tb_transaksi')
            ->leftJoin('tb_jasa', 'tb_transaksi.jenis_jasa', '=', 'tb_jasa.id')
            ->select('tb_transaksi.*', 'tb_jasa.nama_jasa', 'tb_jasa.harga_satuan')
            ->where('tb_transaksi.id_transaksi', $id)
            ->first();

        if (!$transaksi) {
            abort(404, 'Data transaksi tidak ditemukan');
        }

        return view('layouts.cetak_transaksi', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jasa = DB::table('tb_jasa')->get();

        return view('layouts.tambah_transaksi', compact('jasa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_pelanggan' => 'required|string|max:100',
            'jenis_jasa' => 'required|integer|exists:tb_jasa,id',
            'jumlah_kg' => 'required|numeric|gt:0',
            'status_pembayaran' => 'required|in:Belum dibayar,Sudah dibayar,Hutang',
        ]);

        $hargaSatuan = DB::table('tb_jasa')
            ->where('id', $validated['jenis_jasa'])
            ->value('harga_satuan');

        DB::table('tb_transaksi')->insert([
            'tanggal' => $validated['tanggal'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'jenis_jasa' => $validated['jenis_jasa'],
            'jumlah_kg' => $validated['jumlah_kg'],
            'total' => $validated['jumlah_kg'] * $hargaSatuan,
            'status_pembayaran' => $validated['status_pembayaran'],
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
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
        $transaksi = DB::table('tb_transaksi')->where('id_transaksi', $id)->first();

        if (!$transaksi) {
            abort(404, 'Data tidak ditemukan');
        }

        $jasa = DB::table('tb_jasa')->get();

        return view('layouts.ubah_transaksi', compact('transaksi', 'jasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_pelanggan' => 'required|string|max:100',
            'jenis_jasa' => 'required|integer|exists:tb_jasa,id',
            'jumlah_kg' => 'required|numeric|gt:0',
            'status_pembayaran' => 'required|in:Belum dibayar,Sudah dibayar,Hutang',
        ]);

        $hargaSatuan = DB::table('tb_jasa')
            ->where('id', $validated['jenis_jasa'])
            ->value('harga_satuan');

        DB::table('tb_transaksi')->where('id_transaksi', $id)->update([
            'tanggal' => $validated['tanggal'],
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'jenis_jasa' => $validated['jenis_jasa'],
            'jumlah_kg' => $validated['jumlah_kg'],
            'total' => $validated['jumlah_kg'] * $hargaSatuan,
            'status_pembayaran' => $validated['status_pembayaran'],
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('tb_transaksi')->where('id_transaksi', $id)->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
