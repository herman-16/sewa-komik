<?php

namespace App\Http\Controllers;

use App\Models\Komik;
use Illuminate\Http\Request;

class KomikController extends Controller
{
    public function show($id, Request $request) {
        return Komik::find($id);
    }
    
    public function index() {
        return Komik::all();
    }

    public function store(Request $request) {
        $komik = Komik::create($request->all());
        return response()->json($komik, 201);
    }

    public function update($id, Request $request) {
        $komik = Komik::findOrFail($id);
        $komik->update($request->all());
        return response()->json($komik);
    }

    public function destroy($id) {
        Komik::findOrFail($id)->delete();
        return response()->json(['message' => 'Komik dihapus']);
    }
}
