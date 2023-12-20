<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'company_name' => 'oracil2',
                'company_phone' => '1234567822',
                'company_email' => 'oracail@gmail.com',
                'company_address' => 'gaza2',
                'company_manager' => 'abd alkarem2',
                'company_description' => 'programing2',
                'payment_selling_account_index_id' => '31',
                'payment_parchasing_account_index_id' => '28',
                'inbox_account_index_id' => '3',
                'salary_account_index_id' => '39',
                'customers_account_index_id' => '8',
                'suppliers_account_index_id' => '20',
                'discount_earned_account_index_id' => '30',
                'allowed_discount_account_index_id' => '34',
            ]
        ]);
    }
}
