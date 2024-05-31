<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $date_time = Carbon::now()->toDateTimeString();
        $token = Str::random(64);
        $data = array(
            [
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
            [
                'username' => 'palahady',
                'password' => Hash::make('123456'),
                'role' => 'guru',
            ],
            [
                'username' => 'firman',
                'password' => Hash::make('123456'),
                'role' => 'siswa',
            ],
            [
                'username' => 'hasyim',
                'password' => Hash::make('123456'),
                'role' => 'kepsek',
            ],
            [
                'username' => 'riki',
                'password' => Hash::make('123456'),
                'role' => 'wakasek',
            ],

        );
        User::insert($data);
    }
}
