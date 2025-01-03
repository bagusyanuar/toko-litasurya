<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AttendanceController extends Controller
{
    /**
     * Load jadwal dan kunjungan seminggu ke depan.
     */

    public function getWeeklySchedule()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user || !$user->sales) {
            return response()->json(['error' => 'Sales data not found for the logged-in user.'], 404);
        }

        $salesId = $user->sales->id;

        try {
            if (!$salesId) {
                return response()->json(['error' => 'Sales ID is required'], 400);
            }

            // Tentukan tanggal mulai dan akhir untuk minggu ini
            $startDate = Carbon::now()->startOfDay();
            $endDate = $startDate->copy()->addDays(6)->endOfDay(); // 7 hari ke depan

            // Tentukan tanggal mulai dan akhir untuk minggu lalu
            $lastWeekStartDate = $startDate->copy()->subDays(7)->startOfDay();
            $lastWeekEndDate = $startDate->copy()->subDay()->endOfDay();

            // Ambil semua hari dalam minggu sebagai indeks (0 = Minggu, 6 = Sabtu)
            $daysOfWeek = range(0, 6);

            // Dapatkan semua route yang relevan
            $routes = Route::where('sales_id', $salesId)
                ->whereIn('day_of_week', $daysOfWeek)
                ->with(['attendances' => function ($query) use ($lastWeekStartDate, $endDate) {
                    $query->whereBetween('date', [$lastWeekStartDate, $endDate]); // Data absensi dari minggu lalu sampai minggu depan
                }, 'customer'])
                ->get();

            // Proses data untuk pengelompokan berdasarkan tanggal minggu ini
            $schedule = [];
            foreach ($daysOfWeek as $dayOfWeek) {
                $date = $startDate->copy()->addDays(($dayOfWeek - $startDate->dayOfWeek + 7) % 7)->format('Y-m-d');

                // Cek apakah $date adalah hari ini
                $isToday = $date == Carbon::today()->format('Y-m-d'); // Menyimpan apakah date adalah hari ini

                $dayRoutes = $routes->where('day_of_week', $dayOfWeek);

                foreach ($dayRoutes as $route) {
                    $status = 'Pending';
                    $attendance = $route->attendances->firstWhere('date', $date);

                    if ($attendance) {
                        $status = $attendance->status;
                    }

                    if ($status == "Pending") {
                        $schedule[$date][] = [
                            'id' => $route->id,
                            'customer' => $route->customer,
                            'status' => $status,
                            'canopen' => $isToday, // Menetapkan canopen sesuai dengan apakah date adalah hari ini
                        ];
                    } else {
                        $schedule[$date][] = [
                            'attendance_date' => $attendance->date,
                            'attendance_time' => $attendance->created_at,
                            'attendance_reason' => $attendance->reason,
                            'attendance_image' => $attendance->image,
                            'id' => $route->id,
                            'customer' => $route->customer,
                            'status' => $status,
                            'canopen' => $isToday, // Menetapkan canopen sesuai dengan apakah date adalah hari ini
                        ];
                    }
                }
            }


            // Urutkan schedule berdasarkan tanggal (key array)
            $schedule = collect($schedule)->sortKeys()->toArray();

            // Proses data untuk toko dengan status "Pending" minggu lalu
            $pendingLastWeek = [];
            foreach ($routes as $route) {
                $status = 'Pending';
                $routeLastWeekDate = $lastWeekStartDate->copy()->addDays(($route->day_of_week - $lastWeekStartDate->dayOfWeek + 7) % 7)->format('Y-m-d');

                // Cek apakah route belum memiliki attendance untuk minggu lalu
                $attendanceLastWeek = $route->attendances->firstWhere('date', $routeLastWeekDate);

                if ($attendanceLastWeek) {
                    $status = $attendanceLastWeek->status;
                }

                // if (!$attendanceLastWeek) {

                if ($status == "Pending") {
                    $pendingLastWeek[$routeLastWeekDate][] = [
                        'id' => $route->id,
                        'customer' => $route->customer,
                        'status' =>  $status,
                        'canopen' => true,
                    ];
                } else {

                    $pendingLastWeek[$routeLastWeekDate][] = [
                        'attendance_date' => $attendanceLastWeek->date,
                        'attendance_time' => $attendanceLastWeek->created_at,
                        'attendance_reason' => $attendanceLastWeek->reason,
                        'attendance_image' => $attendanceLastWeek->image,
                        'id' => $route->id,
                        'customer' => $route->customer,
                        'status' =>  $status,
                        'canopen' => true,
                    ];
                }


                // }

                // Proses data untuk toko dengan status "Pending" minggu lalu

                // if (!$attendanceLastWeek) {
                //     $pendingLastWeek[$routeLastWeekDate][] = [
                //         'id' => $route->id,
                //         'customer' => $route->customer,
                //         'status' =>  $status,
                //         'canopen' => true,
                //     ];
                // }
            }

            // Return hasil dalam format JSON
            return response()->json([
                'data' => $schedule,
                'pending-lastweek' => $pendingLastWeek,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getTodaySchedule()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user || !$user->sales) {
            return response()->json(['error' => 'Sales data not found for the logged-in user.'], 404);
        }

        $salesId = $user->sales->id;

        try {
            if (!$salesId) {
                return response()->json(['error' => 'Sales ID is required'], 400);
            }

            // Tentukan tanggal hari ini
            $today = Carbon::now()->startOfDay();
            $endOfDay = $today->copy()->endOfDay(); // Sampai akhir hari ini

            // Ambil hari ini (0 = Minggu, 6 = Sabtu)
            $dayOfWeek = $today->dayOfWeek;

            // Dapatkan semua route yang relevan untuk hari ini
            $routes = Route::where('sales_id', $salesId)
                ->where('day_of_week', $dayOfWeek)
                ->with(['attendances' => function ($query) use ($today, $endOfDay) {
                    $query->whereBetween('date', [$today, $endOfDay]); // Data absensi untuk hari ini
                }, 'customer'])
                ->get();

            // Proses data untuk hari ini
            $todaySchedule = [];
            foreach ($routes as $route) {
                $status = 'Pending';
                $attendance = $route->attendances->firstWhere('date', $today->format('Y-m-d'));

                if ($attendance) {
                    $status = $attendance->status;
                }

                // Menambahkan data ke array sesuai format yang diminta
                if ($status == "Pending") {
                    $todaySchedule[] = [

                        'id' => $route->id,
                        'customer' => $route->customer,
                        'status' => $status,
                        'canopen' => true,
                    ];
                } else {
                    $todaySchedule[] = [
                        'attendance_date' => $attendance->date,
                        'attendance_time' => $attendance->created_at,
                        'attendance_reason' => $attendance->reason,
                        'attendance_image' => $attendance->image,
                        'id' => $route->id,
                        'customer' => $route->customer,
                        'status' => $status,
                        'canopen' => true,
                    ];
                }
            }

            // Return hasil dalam format JSON
            return response()->json([
                'data' => $todaySchedule,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'route_id' => 'required|uuid',
            'date' => 'required|date',
            'status' => 'required|string|in:Dikunjungi,Dilewatkan',
            'reason' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Validasi file gambar
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Menangani upload gambar
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Upload gambar dan simpan di storage/app/public/attendances
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName(); // Nama file gambar unik
                $image->storeAs('attendances', $imageName, 'public'); // Menyimpan file gambar ke dalam storage/public/attendances
                $imagePath = 'storage/attendances/' . $imageName; // Path gambar yang akan disimpan di database
            }

            // Simpan data ke database
            $attendance = Attendance::create([
                'id' => \Illuminate\Support\Str::uuid(), // UUID auto-generated
                'route_id' => $request->route_id,
                'date' => $request->date,
                'status' => $request->status,
                'reason' => $request->reason,
                'image' => $imagePath, // Simpan path gambar di database
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data attendance berhasil disimpan.',
                'data' => $attendance,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data attendance.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
