<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ─── Admin ──────────────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@soulkeep.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'status'   => 'active',
            ]
        );

        // ─── Therapist ──────────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'therapist@soulkeep.com'],
            [
                'name'     => 'Dr. Sari',
                'password' => Hash::make('therapist123'),
                'role'     => 'therapist',
                'status'   => 'active',
                'bio'      => 'Psikolog klinis berpengalaman 5 tahun. Spesialisasi: kecemasan, depresi, dan burnout akademik. Siap membantu perjalanan kesehatan mentalmu.',
                'address'  => 'Jakarta, Indonesia',
            ]
        );

        // ─── Regular User ────────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'user@soulkeep.com'],
            [
                'name'     => 'User Demo',
                'password' => Hash::make('user123'),
                'role'     => 'user',
                'status'   => 'active',
            ]
        );
    }
}
