<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Http\Resources\BarangResource;

class BarangApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $barang = Barang::all(); // Tidak menggunakan eager loading

        return response()->json([
            'success' => true,
            'data' => BarangResource::collection($barang), // Menggunakan resource
        ], 200);
    }
}
