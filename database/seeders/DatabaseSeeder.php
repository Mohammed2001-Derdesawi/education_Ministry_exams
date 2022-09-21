<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $speclizations=['مديري المدارس',' المشرفين التربويين'];
        $offices=[
            'مكتب الشرق',
            'مكتب الشمال',
            'مكتب الصفا',
            'مكتب الوسط',
            'مكتب الجنوب',
            'مكتب النسيم',
        ];

        foreach($speclizations as $spe)
        {
            Specialization::create([
                'specialization'=>$spe
            ]);
        }
        foreach($offices as $office)
        {
            Office::create([
                'name'=>$office
            ]);
        }


    }
}
