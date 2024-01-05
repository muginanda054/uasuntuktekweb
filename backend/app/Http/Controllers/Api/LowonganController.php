<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LowonganResource;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::latest()->paginate(5);
        return new LowonganResource(true, 'List Data Lowongan', $lowongans);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $lowongan = Lowongan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
        ]);

        return new LowonganResource(true, 'Data Lowongan Berhasil Ditambahkan', $lowongan);
    }

    public function show($id)
    {
        $lowongan = Lowongan::find($id);
        return new LowonganResource(true, 'Detail Data Lowongan', $lowongan);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $lowongan = Lowongan::find($id);

        $lowongan->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
        ]);

        return new LowonganResource(true, 'Data Lowongan Berhasil Diubah', $lowongan);
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::find($id);
        $lowongan->delete();
        return new LowonganResource(true, 'Data Lowongan Berhasil Dihapus', null);
    }
}
