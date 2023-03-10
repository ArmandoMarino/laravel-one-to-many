<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 20; $i++) {
            $project = new Project();

            $project->title = $faker->text(20);
            $project->description = $faker->paragraphs(15, true);
            // $project->image = $faker->imageUrl(250, 250);
            $project->slug = Str::slug($project->title, '-');
            $project->is_published = $faker->boolean();

            $project->save();
        }
    }
}
