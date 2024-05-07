<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('history_transaksi')->truncate();
        DB::table('kategori')->truncate();
        DB::table('barang')->truncate();
        $data = [
            [
                'nama_barang' => 'Kopi',
                'stok' => 100,
                'jumlah_terjual' => 10,
                'tanggal_transaksi' => date('Y-m-d'),
                'jenis_barang' => 'Konsumsi',
            ],
            [
                'nama_barang' => 'Teh',
                'stok' => 100,
                'jumlah_terjual' => 19,
                'tanggal_transaksi' => date('Y-m-d'),
                'jenis_barang' => 'Konsumsi',
            ],
            [
                'nama_barang' => 'Pasta Gigi',
                'stok' => 100,
                'jumlah_terjual' => 10,
                'tanggal_transaksi' => date('Y-m-d'),
                'jenis_barang' => 'Pembersih',
            ],
            [
                'nama_barang' => 'Sabun Mandi',
                'stok' => 100,
                'jumlah_terjual' => 10,
                'tanggal_transaksi' => date('Y-m-d'),
                'jenis_barang' => 'Pembersih',
            ],
            [
                'nama_barang' => 'Sampo',
                'stok' => 100,
                'jumlah_terjual' => 10,
                'tanggal_transaksi' => date('Y-m-d'),
                'jenis_barang' => 'Konsumsi',
            ],
        ];

        foreach($data as $d){
            $checkKategori = DB::table('kategori')
                            ->where('kategori_nama', $d['jenis_barang'])
                            ->first();
            if($checkKategori){
                $insertBarang = DB::table('barang')
                                ->insertGetId([
                                    'barang_nama' => $d['nama_barang'],
                                    'barang_stok' => $d['stok'],
                                    'kategori_id' => $checkKategori->kategori_id,
                                    'created_at' => now(),
                                ]);
                $insertHistory = DB::table('history_transaksi')
                                ->insert([
                                    'barang_id' => $insertBarang,
                                    'historytransaksi_terjual' => $d['jumlah_terjual'],
                                    'historytransaksi_tanggal' => $d['tanggal_transaksi'],
                                    'created_at' => now()
                                ]);
            }else{
                $insertKategori = DB::table('kategori')
                                ->insertGetId([
                                    'kategori_nama' => $d['jenis_barang'],
                                    'created_at' => now(),
                                ]);
                $insertBarang = DB::table('barang')
                                ->insertGetId([
                                    'barang_nama' => $d['nama_barang'],
                                    'barang_stok' => $d['stok'],
                                    'kategori_id' => $insertKategori,
                                    'created_at' => now(),
                                ]);
                $insertHistory = DB::table('history_transaksi')
                                ->insert([
                                    'barang_id' => $insertBarang,
                                    'historytransaksi_terjual' => $d['jumlah_terjual'],
                                    'historytransaksi_tanggal' => $d['tanggal_transaksi'],
                                    'created_at' => now()
                                ]);
            }
        }
    }
}
