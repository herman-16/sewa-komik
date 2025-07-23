<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function index()
    {
        return Sewa::all();
    }

    public function show($id, Request $request) {
        return Sewa::find($id);
    }

    public function store(Request $request)
    {
        $user = $request->get('user'); // dari BasicAuthMiddleware

        // Validasi
        $this->validate($request, [
            'komik_id' => 'required|exists:komiks,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
        ]);

        // Simpan data sewa
        $sewa = Sewa::create([
            'user_id' => $user->id,
            'komik_id' => $request->input('komik_id'),
            'tanggal_sewa' => $request->input('tanggal_sewa'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
            'status' => 'dipinjam',
        ]);


        return response()->json($sewa, 201);
    }

    public function update($id, Request $request) {
        $sewa = Sewa::findOrFail($id);
        $sewa->update($request->all());
        return response()->json($sewa);
    }

    public function destroy($id) {
        Sewa::findOrFail($id)->delete();
        return response()->json(['message' => 'Data penyewa dihapus']);
    }

    // Jika kamu tidak pakai method `sewa()`, hapus saja agar tidak membingungkan
}
