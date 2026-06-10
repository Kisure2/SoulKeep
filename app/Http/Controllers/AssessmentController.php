<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    // Simpan hasil tes stres ke database
    public function store(Request $request)
    {
        $assessment = auth()->guard('api')->user()->assessments()->create([
            'total_score'     => $request->total_score,
            'level'           => $request->level,
            'category_scores' => $request->category_scores,
        ]);

        return response()->json([
            'message' => 'Hasil tes stres berhasil disimpan.',
            'data'    => $assessment
        ], 201);
    }

    // Ambil 5 hasil tes terakhir milik user
    public function index()
    {
        $assessments = auth()->guard('api')->user()
            ->assessments()
            ->latest()
            ->take(5)
            ->get();

        return response()->json($assessments);
    }
}
