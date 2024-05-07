<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Kategori;

class KategoriController extends Controller
{
    public function getKategori(){
        $kategori = M_Kategori::get();
        $response = [
            'msg_code' => 200,
            'msg_status' => 'success',
            'data' => $kategori
        ];
        return response()->json($response);
    }

    public function post(Request $request){
        $insert = M_Kategori::insert([
            'kategori_nama' => $request->nama_kategori,
            'created_at' => now(),
        ]);
        $response = [
            'msg_code' => 200,
            'msg_status' => 'success',
            'data' => M_Kategori::get(),
        ];
        return response()->json($response);
    }

    public function delete(Request $request){
        $delete = M_Kategori::where('kategori_id', $request->kategoriId)->delete();
        $response = [
            'msg_code' => 200,
            'msg_status' => 'success',
        ];
        return response()->json($response);
    }

    public function update(Request $request){
        $update = M_Kategori::where('kategori_id', $request->id)
                ->update([
                    'kategori_nama' => $request->nama_kategori,
                    'updated_at' => now(),
                ]);
        $response = [
            'msg_code' => 200,
            'msg_status' => 'success',
        ];
        return response()->json($response);
    }
}
