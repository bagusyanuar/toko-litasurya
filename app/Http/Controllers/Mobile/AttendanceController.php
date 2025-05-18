<?php

namespace App\Http\Controllers\Mobile;

use App\Commons\JWT\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Route;
use App\Models\SalesTeam;
use App\Models\SalesTeamSchedule;
use App\Models\SalesTeamVisit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Load jadwal dan kunjungan seminggu ke depan.
     */

    public function getWeeklySchedule()
    {
        $user = Auth::user();
        $salesTeam = SalesTeam::where('user_id', $user->id)->first();

        if (!$salesTeam) {
            return response()->json(['error' => 'Sales team not found for the logged-in user.'], 404);
        }

        $salesTeamId = $salesTeam->id;

        try {
            $startDate = Carbon::now()->startOfDay();
            $endDate = $startDate->copy()->addDays(6)->endOfDay();

            $lastWeekStartDate = $startDate->copy()->subDays(7)->startOfDay();
            $lastWeekEndDate = $startDate->copy()->subDay()->endOfDay();

            $daysOfWeek = range(0, 6);

            $schedules = SalesTeamSchedule::where('sales_team_id', $salesTeamId)
                ->whereIn('day', $daysOfWeek)
                ->with(['route.details.customer'])
                ->get();

            // return response()->json(['schedules' => $schedules], 404);

            $schedule = [];

            foreach ($daysOfWeek as $dayOfWeek) {
                $date = $startDate->copy()->addDays(($dayOfWeek - $startDate->dayOfWeek + 7) % 7)->format('Y-m-d');
                $isToday = $date == Carbon::today()->format('Y-m-d');

                $dailySchedules = $schedules->where('day', $dayOfWeek);



                foreach ($dailySchedules as $scheduleItem) {
                    foreach ($scheduleItem->route->details as $detail) {
                        $customer = $detail->customer;

                        // Cek apakah ada visit untuk tanggal ini
                        $visit = SalesTeamVisit::where('sales_team_id', $salesTeamId)
                            ->where('store_id', $customer->id)
                            ->whereDate('visited_at', $date)
                            ->first();

                        if ($visit) {
                            $schedule[$date][] = [
                                'customer' => [
                                    'name'     => $visit->store->name ?? null,
                                    'id'       => $visit->store->id ?? null,
                                    'address'  => $visit->store->address ?? null,
                                    'phone'    => $visit->store->phone ?? null,
                                ],
                                'status'            => $visit->status,
                                'date'              => $date,
                                'absensi_datetime'  => $visit->created_at,
                                'alasan'            => $visit->description,
                                'image_path'        => $visit->image,
                                'canopen'           => $isToday,
                            ];
                        } else {
                            $schedule[$date][] = [
                                'customer' => [
                                    'name'     => $customer->name ?? null,
                                    'id'       => $customer->id ?? null,
                                    'address'  => $customer->address ?? null,
                                    'phone'    => $customer->phone ?? null,
                                ],
                                'status'            => 'Pending',
                                'date'              => $date,
                                'absensi_datetime'  => null,
                                'alasan'            => null,
                                'image_path'        => null,
                                'canopen'           => $isToday,
                            ];
                        }
                    }
                }
            }

            // Proses pending minggu lalu
            $pendingLastWeek = [];

            foreach ($schedules as $scheduleItem) {
                $day = $scheduleItem->day;
                $date = $lastWeekStartDate->copy()->addDays(($day - $lastWeekStartDate->dayOfWeek + 7) % 7)->format('Y-m-d');

                foreach ($scheduleItem->route->details as $detail) {
                    $customer = $detail->customer;

                    $visit = SalesTeamVisit::where('sales_team_id', $salesTeamId)
                        ->where('store_id', $customer->id)
                        ->whereDate('visited_at', $date)
                        ->first();


                    if ($visit) {
                        $pendingLastWeek[$date][] = [
                            'customer' => [
                                'id'      => $visit->store->id ?? null,
                                'name'    => $visit->store->name ?? null,
                                'address' => $visit->store->address ?? null,
                                'phone'   => $visit->store->phone ?? null,
                            ],
                            'status'            => $visit->status,
                            'date'              => $date,
                            'absensi_datetime'  => $visit->created_at,
                            'alasan'            => $visit->description,
                            'image_path'        => $visit->image,
                            'canopen'           => true,
                        ];
                    } else {
                        $pendingLastWeek[$date][] = [
                            'customer' => [
                                'id'      => $customer->id ?? null,
                                'name'    => $customer->name ?? null,
                                'address' => $customer->address ?? null,
                                'phone'   => $customer->phone ?? null,
                            ],
                            'status'            => 'Pending',
                            'date'              => $date,
                            'absensi_datetime'  => null,
                            'alasan'            => null,
                            'image_path'        => null,
                            'canopen'           => true,
                        ];
                    }
                }

                krsort($pendingLastWeek);
            }

            return response()->json([
                'data' => collect($schedule)->sortKeys()->toArray(),
                'pending-lastweek' => $pendingLastWeek,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function getTodaySchedule()
    {
        $user = Auth::user();
        $salesTeam = SalesTeam::where('user_id', $user->id)->first();

        if (!$salesTeam) {
            return response()->json(['error' => 'Sales team not found for the logged-in user.'], 404);
        }

        $salesTeamId = $salesTeam->id;

        try {
            $today = Carbon::now()->startOfDay();
            $endOfDay = $today->copy()->endOfDay();
            $dayOfWeek = $today->dayOfWeek;

            // Ambil semua jadwal hari ini berdasarkan sales team
            $schedules = SalesTeamSchedule::where('sales_team_id', $salesTeamId)
                ->where('day', $dayOfWeek)
                ->with(['route.details.customer']) // chaining: schedule → route → routeDetails → customer
                ->get();

            // return response()->json(['schedules' => $schedules], 404);

            $todaySchedule = [];

            foreach ($schedules as $schedule) {
                foreach ($schedule->route->details as $routeDetail) {
                    $customer = $routeDetail->customer;

                    // Cari visit (absensi) hari ini berdasarkan sales_team_id dan customer_id
                    $visit = SalesTeamVisit::with('store') // asumsi relasi bernama 'store'
                        ->where('sales_team_id', $salesTeamId)
                        ->where('store_id', $customer->id)
                        ->whereBetween('visited_at', [$today, $endOfDay])
                        ->first();

                    if ($visit) {
                        $todaySchedule[] = [
                            'name'              => $visit->store->name ?? null,
                            'id_customer'       => $visit->store->id ?? null,
                            'address'           => $visit->store->address ?? null,
                            'phone'             => $visit->store->phone ?? null,
                            'status'            => $visit->status,
                            'date'              => $visit->visited_at,
                            'absensi_datetime'  => $visit->created_at, // atau `->created_at` kalau kamu simpan waktu di sana
                            'alasan'            => $visit->description,
                            'image_path'        => $visit->image,


                        ];
                    } else {
                        $todaySchedule[] = [
                            'id' => $routeDetail->id,
                            'customer' => $customer,
                            'status' => 'Pending',
                            'canopen' => true,
                        ];
                    }
                }
            }

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
            'store_id' => 'required|uuid',
            'sales_team_id' => 'required|uuid',
            'visited_at' => 'required|date',
            'status' => 'required|string|in:Dikunjungi,Dilewatkan',
            'description' => 'nullable|string',
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
            $attendance = SalesTeamVisit::create([
                'id' => \Illuminate\Support\Str::uuid(), // UUID auto-generated
                // 'route_id' => $request->route_id,
                'store_id' => $request->store_id,
                'sales_team_id' => $request->sales_team_id,
                'visited_at' => $request->visited_at,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $imagePath, // Simpan path gambar di database
            ]);

            return response()->json([
                'status' => 'success',
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
