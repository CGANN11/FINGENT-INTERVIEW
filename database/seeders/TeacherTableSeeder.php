<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = now();
        $userList = array(
            [
                'name' => 'Katie',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'name' => 'Max',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'George',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]
        );
        Schema::disableForeignKeyConstraints();
        Teacher::truncate();
        Schema::enableForeignKeyConstraints();
        Teacher::insert($userList);
    }
}
