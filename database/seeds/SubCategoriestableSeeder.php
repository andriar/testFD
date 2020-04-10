<?php

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategoriestableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SubCategory::class, 5)->create();
    }
}
