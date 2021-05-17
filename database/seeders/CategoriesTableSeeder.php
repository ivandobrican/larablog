<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $html = new Category();
        $html->slug = 'html';
        $html->name = 'HTML';
        $html->save();

        $css = new Category();
        $css->slug = 'css';
        $css->name = 'CSS';
        $css->save();

        $php = new Category();
        $php->slug = 'php';
        $php->name = 'PHP';
        $php->save();
    }
}
