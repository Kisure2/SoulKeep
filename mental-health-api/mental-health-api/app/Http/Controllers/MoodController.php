<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
        // Mengambil riwayat mood khusus milik user yang sedang login via JWT
        $moods = auth()->guard('api')->user()->moods()->orderBy('created_at', 'desc')->get();
        return response()->json($moods);
    }

    public function store(Request $request)
    {
        // Menyimpan data mood baru yang otomatis terikat dengan user ID
        $mood = auth()->guard('api')->user()->moods()->create([
            'score' => $request->score,
            'notes' => $request->notes
        ]);

        return response()->json(['message' => 'Mood berhasil disimpan secara anonim!', 'data' => $mood], 201);
    }

    public function destroy($id)
    {
        // Hapus mood entry — hanya bisa hapus milik user sendiri
        $mood = auth()->guard('api')->user()->moods()->find($id);

        if (!$mood) {
            return response()->json(['error' => 'Data mood tidak ditemukan atau bukan milik Anda.'], 404);
        }

        $mood->delete();
        return response()->json(['message' => 'Mood berhasil dihapus.']);
    }

    public function stats()
    {
        $moods = auth()->guard('api')->user()->moods()->orderBy('created_at', 'desc')->get();

        $total = $moods->count();
        $avg7 = $moods->take(7)->avg('score') ?? 0;
        $avg7prev = $moods->skip(7)->take(7)->avg('score') ?? 0;

        // Hitung streak: berapa hari berturut-turut user mencatat mood
        $streak = 0;
        $today = now()->startOfDay();
        $checkedDays = [];

        foreach ($moods as $mood) {
            $moodDay = \Carbon\Carbon::parse($mood->created_at)->startOfDay()->toDateString();
            if (!in_array($moodDay, $checkedDays)) {
                $checkedDays[] = $moodDay;
            }
        }

        sort($checkedDays);
        $checkedDays = array_reverse($checkedDays);

        if (!empty($checkedDays)) {
            $todayStr = $today->toDateString();
            $yesterdayStr = $today->copy()->subDay()->toDateString();

            // Streak valid jika hari ini atau kemarin ada data
            if ($checkedDays[0] === $todayStr || $checkedDays[0] === $yesterdayStr) {
                $streak = 1;
                $expectedDate = \Carbon\Carbon::parse($checkedDays[0])->subDay();

                for ($i = 1; $i < count($checkedDays); $i++) {
                    if ($checkedDays[$i] === $expectedDate->toDateString()) {
                        $streak++;
                        $expectedDate->subDay();
                    } else {
                        break;
                    }
                }
            }
        }

        return response()->json([
            'total' => $total,
            'avg_7_days' => round($avg7, 1),
            'avg_7_days_prev' => round($avg7prev, 1),
            'streak' => $streak,
        ]);
    }
}