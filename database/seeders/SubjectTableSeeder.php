<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class SubjectTableSeeder extends Seeder
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
                'subject_name' => 'Maths',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ],
            [
                'subject_name' => 'Science',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'subject_name' => 'History',
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]
        );
        Schema::disableForeignKeyConstraints();
        Subject::truncate();
        Schema::enableForeignKeyConstraints();
        Subject::insert($userList);
    }
}
