<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'company_name' => 'コカ・コーラ',
            'street_address' => '東京都港区六本木1-2-3',
            'representative_name' => '山田 太郎',
        ]);

        Company::create([
            'company_name' => 'サントリー',
            'street_address' => '東京都港区台場2-3-4',
            'representative_name' => '佐藤 次郎',
        ]);

        Company::create([
            'company_name' => '伊藤園',
            'street_address' => '東京都渋谷区本町3-4-5',
            'representative_name' => '鈴木 三郎',
        ]);
    }
}