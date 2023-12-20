<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NatureAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nature_accounts')->insert([
            [
                'title' => 'مدين فقط'
            ],[
                'title' => 'دائن فقط'
            ],[
                'title' => 'مدين دائن'
            ]
        ]);
    }
}
