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
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $adminEmail = env('SEED_ADMIN_EMAIL') ?: 'admin@telkomuniversity.ac.id';
        $adminPassword = env('SEED_ADMIN_PASSWORD') ?: 'password';
        $adminName = env('SEED_ADMIN_NAME') ?: 'Admin IT Support';

        $userEmail = env('SEED_USER_EMAIL') ?: 'user@telkomuniversity.ac.id';
        $userPassword = env('SEED_USER_PASSWORD') ?: 'password';
        $userName = env('SEED_USER_NAME') ?: 'Staff User';

        $admin = User::query()->firstOrNew(['email' => $adminEmail]);
        $admin->fill([
            'name'     => $adminName,
            'password' => Hash::make($adminPassword),
        ]);
        $admin->role = User::ROLE_ADMIN;
        $admin->email_verified_at ??= now();
        $admin->save();

        $visitor = User::query()->firstOrNew(['email' => $userEmail]);
        $visitor->fill([
            'name'     => $userName,
            'password' => Hash::make($userPassword),
        ]);
        $visitor->role = User::ROLE_USER;
        $visitor->email_verified_at ??= now();
        $visitor->save();

        $this->call(PcAssetSeeder::class);
    }
}
