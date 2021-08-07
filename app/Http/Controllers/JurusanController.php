<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Penjurusan;
use App\Models\Detail_Penjurusan;

class JurusanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add(Request $request)
    {
        $nama_penjurusan = $request->input('nama_penjurusan');
        $kuota_maks = $request->input('kuota_maks');

        $addJurusan = Penjurusan::create([
            'nama_penjurusan' => $nama_penjurusan,
            'kuota_maks' => $kuota_maks,

        ]);

        if ($addJurusan){
            return response()->json(
                $addJurusan
                , 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Add Jurusan Fail',
                    'data'=>''
                ], 400);
        }

    }

    public function login(Request $request)
    {

    }

    public function addToDetail(Request $request)
    {
        $id_penjurusan = $request->input('id_penjurusan');
        $id_user = $request->input('id_user');

        $addDetail = Detail_Penjurusan::create([
            'id_penjurusan' => $id_penjurusan,
            'id_user' => $id_user,

        ]);

        if ($addDetail){
            return response()->json(
                $addDetail
                , 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Add detail Fail',
                    'data'=>''
                ], 400);
        }

    }
}
