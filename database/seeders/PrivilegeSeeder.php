<?php

namespace Database\Seeders;

use App\Models\Privilege;
use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Privilege::create(['id' => 1, 'name' => 'Superuser', 'menu_ids' => '0', 'privileges' => '0']);
    }
}
