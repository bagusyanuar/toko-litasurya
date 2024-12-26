<?php

namespace App\Http\Controllers\Api;

use App\Models\DailyTarget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyTargetController extends Controller
{
    /**
     * Menampilkan target untuk hari ini.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodayTarget()
    {
        // Mengambil target terakhir berdasarkan tanggal (sorted descending)
        $lastTarget = DailyTarget::orderBy('date', 'desc')->first();

        // Jika ada target, kita kembalikan target tersebut
        if ($lastTarget) {
            return response()->json([
                'status' => 'success',
                'data' => $lastTarget,
            ], 200);
        }

        // Jika tidak ada target sebelumnya, kembalikan error
        return response()->json([
            'status' => 'error',

            'message' => 'Target tidak ditemukan',
        ], 404);
    }

    /**
     * Menyimpan target baru untuk hari ini.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createTarget(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|integer',
        ]);

        // Cek apakah target untuk hari ini sudah ada
        $today = \Carbon\Carbon::now()->format('Y-m-d'); // Mendapatkan tanggal hari ini
        $existingTarget = DailyTarget::whereDate('date', $today)->first();

        // Jika target hari ini sudah ada, kembalikan response
        if ($existingTarget) {
            return response()->json([
                'status' => 'error',
                'message' => 'Target untuk hari ini sudah ada.',
            ], 400);
        }

        // Jika target hari ini belum ada, ambil target kemarin
        $lastTarget = DailyTarget::orderBy('date', 'desc')->first();

        // Jika ada target sebelumnya, gunakan nilai target tersebut untuk hari ini
        if ($lastTarget) {
            $amount = $lastTarget->amount; // Ambil jumlah target kemarin
        } else {
            // Jika tidak ada target sebelumnya, kita set jumlah target default (misalnya 0 atau nilai lainnya)
            $amount = 0; // Ganti dengan nilai default sesuai kebutuhan
        }

        // Membuat target baru dengan nilai yang sama seperti target kemarin atau default
        $target = DailyTarget::create([
            'date' => $today, // Target untuk hari ini
            'amount' => $amount,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $target,
        ], 201);
    }
}
