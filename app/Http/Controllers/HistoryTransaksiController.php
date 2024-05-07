<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_HistoryTransaksi;
use App\Models\M_Barang;
use App\Models\M_Kategori;

class HistoryTransaksiController extends Controller
{
    public function getTransaksi(Request $request){
        $getTransaksi = M_HistoryTransaksi::orderBy('historytransaksi_tanggal','asc');
        if($request->startDate != '' && $request->endDate != ''){
            $getTransaksi = $getTransaksi->whereBetween('historytransaksi_tanggal', [$request->startDate, $request->endDate])->get();
        }else{
            $getTransaksi = $getTransaksi->get();
        }
        if(count($getTransaksi) > 0){
            foreach($getTransaksi as $gt){
                $fetch = array();
                $fetch['historytransaksi_id'] = $gt->historytransaksi_id;
                $getBarang = M_Barang::where('barang_id', $gt->barang_id)->first();
                $fetch['barang_nama'] = isset($getBarang) ? $getBarang->barang_nama : '-';
                $fetch['barang_stok'] = isset($getBarang) ? $getBarang->barang_stok : '-';
                $fetch['historytransaksi_terjual'] = $gt->historytransaksi_terjual;
                $fetch['historytransaksi_tanggal'] = $gt->historytransaksi_tanggal;
                if(isset($getBarang)){
                    $getKategori = M_Kategori::where('kategori_id', $getBarang->kategori_id)->first();
                    $fetch['kategori_barang'] = $getKategori->kategori_nama;
                }else{
                    $fetch['kategori_barang'] = '-';
                }
                $data[] = $fetch;
            }
            return response()->json([
                'msg_code' => 200,
                'msg_status' => 'sucess',
                'data' => $data,
            ]);
        }else{
            return response()->json([
                'msg_code' => 201,
                'msg_status' => 'failed',
                'data' => array(),
            ]);
        }
    }

    public function postData(Request $request){
        $insert = M_HistoryTransaksi::insert([
            'barang_id' => $request->barang_id,
            'historytransaksi_terjual' => $request->jumlah_terjual,
            'historytransaksi_tanggal' => $request->tanggal_transaksi,
            'created_at' => now(),
        ]);
        return response()->json([
            'msg_code' => 200,
            'msg_status' => 'success'
        ]);
    }
}
