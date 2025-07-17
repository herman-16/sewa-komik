<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function index() {
        return Sewa::with(['user', 'komik'])->get();
    }

    public function sewa(Request $request) {
        $data = $request->all();
        $data['status'] = 'dipinjam';
        $sewa = Sewa::create($data);
        return response()->json($sewa, 201);
    }
}
