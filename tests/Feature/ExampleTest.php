<?php

namespace Tests\Feature;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_dashboard_displays_live_database_data(): void
    {
        config(['session.driver' => 'array']);

        $jasaQuery = \Mockery::mock();
        $jasaQuery->shouldReceive('count')->once()->andReturn(2);

        $transaksiCountQuery = \Mockery::mock();
        $transaksiCountQuery->shouldReceive('count')->once()->andReturn(3);

        $belumDibayarQuery = \Mockery::mock();
        $belumDibayarQuery->shouldReceive('whereIn')
            ->once()
            ->with('status_pembayaran', ['Belum dibayar', 'Hutang'])
            ->andReturnSelf();
        $belumDibayarQuery->shouldReceive('count')->once()->andReturn(2);

        $pendapatanQuery = \Mockery::mock();
        $pendapatanQuery->shouldReceive('whereDate')
            ->once()
            ->with('tanggal', \Mockery::type(\DateTimeInterface::class))
            ->andReturnSelf();
        $pendapatanQuery->shouldReceive('where')
            ->once()
            ->with('status_pembayaran', 'Sudah dibayar')
            ->andReturnSelf();
        $pendapatanQuery->shouldReceive('sum')->once()->with('total')->andReturn(30000);

        $transaksiTerbaruQuery = \Mockery::mock();
        $transaksiTerbaruQuery->shouldReceive('leftJoin')
            ->once()
            ->with('tb_jasa', 'tb_transaksi.jenis_jasa', '=', 'tb_jasa.id')
            ->andReturnSelf();
        $transaksiTerbaruQuery->shouldReceive('select')
            ->once()
            ->with('tb_transaksi.*', 'tb_jasa.nama_jasa')
            ->andReturnSelf();
        $transaksiTerbaruQuery->shouldReceive('orderByDesc')
            ->once()
            ->with('tb_transaksi.tanggal')
            ->andReturnSelf();
        $transaksiTerbaruQuery->shouldReceive('orderByDesc')
            ->once()
            ->with('tb_transaksi.id_transaksi')
            ->andReturnSelf();
        $transaksiTerbaruQuery->shouldReceive('limit')->once()->with(10)->andReturnSelf();
        $transaksiTerbaruQuery->shouldReceive('get')->once()->andReturn(new Collection([
            (object) [
                'id_transaksi' => 2,
                'tanggal' => today()->toDateString(),
                'nama_pelanggan' => 'Budi',
                'jenis_jasa' => 2,
                'nama_jasa' => 'Cuci Setrika',
                'jumlah_kg' => 3,
                'total' => 21000,
                'status_pembayaran' => 'Belum dibayar',
            ],
            (object) [
                'id_transaksi' => 1,
                'tanggal' => today()->toDateString(),
                'nama_pelanggan' => 'Siti',
                'jenis_jasa' => 1,
                'nama_jasa' => 'Cuci Kering',
                'jumlah_kg' => 5,
                'total' => 30000,
                'status_pembayaran' => 'Sudah dibayar',
            ],
        ]));

        DB::shouldReceive('table')
            ->with('tb_jasa')
            ->once()
            ->andReturn($jasaQuery);
        DB::shouldReceive('table')
            ->with('tb_transaksi')
            ->times(4)
            ->andReturn(
                $transaksiCountQuery,
                $belumDibayarQuery,
                $pendapatanQuery,
                $transaksiTerbaruQuery
            );

        $response = $this->get('/');

        $response->assertOk()
            ->assertViewHas('jumlahJasa', 2)
            ->assertViewHas('jumlahTransaksi', 3)
            ->assertViewHas('transaksiBelumDibayar', 2)
            ->assertViewHas('pendapatanHariIni', 30000)
            ->assertViewHas('transaksiTerbaru', function ($transaksi) {
                return $transaksi->count() === 2
                    && $transaksi->first()->nama_jasa === 'Cuci Setrika';
            })
            ->assertSeeText('Budi')
            ->assertSeeText('Cuci Kering')
            ->assertSeeText('Hutang')
            ->assertSeeText('Rp. 30.000');
    }
}
