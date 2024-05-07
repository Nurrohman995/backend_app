<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Barang;

class BarangController extends Controller
{
    public function getBarang(){
        $getBarang = M_Barang::join('kategori','barang.kategori_id','=','kategori.kategori_id')
                    ->select('barang.*','kategori_nama')->get();
        $response = [
            'msg_status' => 'success',
            'msg_code' => 200,
            'data' => $getBarang,
        ];
        return response()->json($response);
    }

    public function postBarang(Request $request){
        $insert = M_Barang::insert([
            'barang_nama' => $request->barang_nama,
            'barang_stok' => $request->barang_stok,
            'kategori_id' => $request->kategori_id,
            'created_at' => now(),
        ]);
        $response = [
            'msg_status' => 'success',
            'msg_code' => 200,
        ];
        return response()->json($response);
    }
}
