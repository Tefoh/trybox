<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()
            ->insert([
                [
                    'id' => 1,
                    'name' => 'customer',
                ],
                [
                    'id' => 2,
                    'name' => 'seller',
                ],
                [
                    'id' => 3,
                    'name' => 'admin',
                ],
            ]);
    }
}
