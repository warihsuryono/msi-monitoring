<?php

namespace Database\Seeders;

use App\Models\menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->truncate();
        menu::create(['id' => 1, 'seqno' => 1, 'parent_id' => 0, 'name' => 'Data', 'url' => '#', 'icon' => 'heroicon-o-chart-bar']);
        menu::create(['id' => 2, 'seqno' => 2, 'parent_id' => 0, 'name' => 'Settings', 'url' => '#', 'icon' => 'heroicon-o-adjustments-vertical']);
        menu::create(['id' => 3, 'seqno' => 3, 'parent_id' => 0, 'name' => 'Database', 'url' => '#', 'icon' => 'heroicon-o-sparkles']);

        menu::create(['id' => 4, 'seqno' => 1, 'parent_id' => 1, 'name' => 'Data', 'url' => 'analyzer-values']);
        menu::create(['id' => 5, 'seqno' => 2, 'parent_id' => 1, 'name' => 'Chart', 'url' => 'analyzer-values/chart']);
        menu::create(['id' => 6, 'seqno' => 3, 'parent_id' => 1, 'name' => 'ISPU', 'url' => 'ispu']);

        menu::create(['id' => 7, 'seqno' => 1, 'parent_id' => 2, 'name' => 'Parameters', 'url' => 'parameters']);
        menu::create(['id' => 8, 'seqno' => 2, 'parent_id' => 2, 'name' => 'Quality Standards', 'url' => 'quality-standards']);
        menu::create(['id' => 9, 'seqno' => 3, 'parent_id' => 2, 'name' => 'Devices Types', 'url' => 'device_types']);
        menu::create(['id' => 10, 'seqno' => 4, 'parent_id' => 2, 'name' => 'Devices', 'url' => 'devices']);

        menu::create(['id' => 11, 'seqno' => 1, 'parent_id' => 3, 'name' => 'Menus', 'url' => 'menus']);
        menu::create(['id' => 12, 'seqno' => 2, 'parent_id' => 3, 'name' => 'Menu Privileges', 'url' => 'privileges']);
        menu::create(['id' => 13, 'seqno' => 3, 'parent_id' => 3, 'name' => 'Units', 'url' => 'units']);
        menu::create(['id' => 14, 'seqno' => 4, 'parent_id' => 3, 'name' => 'Users', 'url' => 'users']);
        menu::create(['id' => 15, 'seqno' => 5, 'parent_id' => 3, 'name' => 'Profile', 'url' => 'profiles']);
    }
}
