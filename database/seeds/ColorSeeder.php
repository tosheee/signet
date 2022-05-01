<?php

use Illuminate\Database\Seeder;
use App\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = new Color();
        $color->name = 'red';
        $color->color = '#ff0000';
        $color->save();

        $color = new Color();
        $color->name = 'orange';
        $color->color = '#FFA500';
        $color->save();

        $color = new Color();
        $color->name = 'cyan';
        $color->color = '#00FFFF';
        $color->save();

        $color = new Color();
        $color->name = 'blue';
        $color->color = '#0000FF';
        $color->save();

        $color = new Color();
        $color->name = 'dark blue';
        $color->color = '#00008B';
        $color->save();

        $color = new Color();
        $color->name = 'light blue';
        $color->color = '#ADD8E6';
        $color->save();

        $color = new Color();
        $color->name = 'purple';
        $color->color = '#800080';
        $color->save();

        $color = new Color();
        $color->name = 'yellow';
        $color->color = '#FFFF00';
        $color->save();

        $color = new Color();
        $color->name = 'lime';
        $color->color = '#00FF00';
        $color->save();

        $color = new Color();
        $color->name = 'magenta';
        $color->color = '#FF00FF';
        $color->save();

        $color = new Color();
        $color->name = 'pink';
        $color->color = '#FFC0CB';
        $color->save();

        $color = new Color();
        $color->name = 'white';
        $color->color = '#FFFFFF';
        $color->save();

        $color = new Color();
        $color->name = 'silver';
        $color->color = '#C0C0C0';
        $color->save();

        $color = new Color();
        $color->name = 'Aquamarine';
        $color->color = '#7FFD4';
        $color->save();

        $color = new Color();
        $color->name = 'gray';
        $color->color = '#808080';
        $color->save();

        $color = new Color();
        $color->name = 'black';
        $color->color = '#000000';
        $color->save();

        $color = new Color();
        $color->name = 'brown';
        $color->color = '#A52A2A';
        $color->save();

        $color = new Color();
        $color->name = 'green';
        $color->color = '#008000';
        $color->save();

        $color = new Color();
        $color->name = 'maroon';
        $color->color = '#800000';
        $color->save();
    }
}
