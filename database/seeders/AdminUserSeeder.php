<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('admin.email')],
            [
                'name' => 'Super Admin',
                'password' => env('ADMIN_PASSWORD', '9638'),
                'email_verified_at' => now(),
            ],
        );
    }
}