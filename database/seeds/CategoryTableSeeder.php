<?php

use Illuminate\Database\Seeder;
use App\Admin\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Фланелки";
        $category->save();

        $category = new Category();
        $category->name = "Калъфи за телефони";
        $category->save();

        $category = new Category();
        $category->name = "Падове за мишки";
        $category->save();

        $category = new Category();
        $category->name = "Чаши";
        $category->save();

        $category = new Category();
        $category->name = "Чиний";
        $category->save();

        $category = new Category();
        $category->name = "Магнити";
        $category->save();

        $category = new Category();
        $category->name = "Пъзели";
        $category->save();

        $category = new Category();
        $category->name = "Рамки";
        $category->save();

        $category = new Category();
        $category->name = "Възглавници";
        $category->save();

        $category = new Category();
        $category->name = "Фоторамки";
        $category->save();

        $category = new Category();
        $category->name = "Часовници";
        $category->save();

        $category = new Category();
        $category->name = "Ключодържатели";
        $category->save();

        $category = new Category();
        $category->name = "Портфейли";
        $category->save();

    }
}
