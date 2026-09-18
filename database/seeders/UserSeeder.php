<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['id' => '1', 'privilege_id' => 1, 'email' => 'superuser@majuselarasinstrumindo.com', 'name' => 'Superuser', 'institution' => '', 'password' => '$2y$12$.lK978LeVq9lRWnwWIMILeQj2/Xh43nB.9Xda94ngtK4HDAsteOj6']);
    }
}
