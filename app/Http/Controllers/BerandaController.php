<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahJasa = DB::table('tb_jasa')->count();
        $jumlahTransaksi = DB::table('tb_transaksi')->count();
        $transaksiBelumDibayar = DB::table('tb_transaksi')
            ->whereIn('status_pembayaran', ['Belum dibayar', 'Hutang'])
            ->count();
        $pendapatanHariIni = DB::table('tb_transaksi')
            ->whereDate('tanggal', today())
            ->where('status_pembayaran', 'Sudah dibayar')
            ->sum('total');
        $transaksiTerbaru = DB::table('tb_transaksi')
            ->leftJoin('tb_jasa', 'tb_transaksi.jenis_jasa', '=', 'tb_jasa.id')
            ->select('tb_transaksi.*', 'tb_jasa.nama_jasa')
            ->orderByDesc('tb_transaksi.tanggal')
            ->orderByDesc('tb_transaksi.id_transaksi')
            ->limit(10)
            ->get();

        return view('layouts.index', compact(
            'jumlahJasa',
            'jumlahTransaksi',
            'transaksiBelumDibayar',
            'pendapatanHariIni',
            'transaksiTerbaru'
        ));
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
