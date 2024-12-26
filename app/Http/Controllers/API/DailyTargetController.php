<?php

namespace App\Http\Controllers\Api;

use App\Models\DailyTarget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DailyTargetController extends Controller
{
    /**
     * Menampilkan target untuk hari ini.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodayTarget()
    {
        // Pastikan target hari ini ada
        $todayTarget = $this->createTargetIfNotExists();

        // Kembalikan target hari ini
        return response()->json([
            'status' => 'success',
            'data' => $todayTarget,
        ], 200);
    }

    /**
     * Membuat target baru untuk hari ini jika belum ada.
     *
     * @return DailyTarget
     */
    private function createTargetIfNotExists()
    {
        $uuid = str_replace('-', '', Str::uuid()->toString());
        $today = \Carbon\Carbon::now()->format('Y-m-d'); // Tanggal hari ini

        // Cek apakah target untuk hari ini sudah ada
        $existingTarget = DailyTarget::whereDate('date', $today)->first();

        if ($existingTarget) {
            return $existingTarget; // Jika sudah ada, kembalikan data tersebut
        }

        // Ambil target terakhir sebagai referensi
        $lastTarget = DailyTarget::orderBy('date', 'desc')->first();
        $amount = $lastTarget ? $lastTarget->amount : 0; // Jika tidak ada target terakhir, gunakan 0

        // Buat target baru untuk hari ini
        return DailyTarget::create([
            'id' => $uuid, // ID unik
            'date' => $today,
            'amount' => $amount,
        ]);
    }
}
