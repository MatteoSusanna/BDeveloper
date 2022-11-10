<?php

use App\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['Html', 'Css', 'JavaScript', 'PHP', 'Java', 'MySql', 'Laravel', 'Symfony', 'Vue', 'React', 'Angular', 'C#'];

        foreach($skills as $skill){
                $newSkill = new Skill();
                $newSkill->name = $skill;
                $newSkill->slug = Str::slug($skill);
                $newSkill->save();
        }
    }
}
