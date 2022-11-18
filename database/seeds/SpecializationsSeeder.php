<?php

use App\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = ['BackEnd', 'FrontEnd', 'FullStack', 'Cyber Security', 'Design', 'System Engineer', 'A.I.', 'Data Scientist'];

        foreach($specializations as $specialization){
                $newSpecialization = new Specialization();
                $newSpecialization->name = $specialization;
                $newSpecialization->slug = Str::slug($specialization);
                $newSpecialization->save();
        }
    }
}
