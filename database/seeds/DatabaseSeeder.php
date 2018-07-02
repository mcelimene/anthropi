<?php

use App\Region;
use App\Trainer;
use App\Level;
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
        $this->call(RegionTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(TrainerTableSeeder::class);
    }
}

class RegionTableSeeder extends Seeder
{
    /**
     * Seed the region's table.
     *
     * @return void
     */
    public function run()
    {
        Region::create(['name' => 'Auvergne-Rhône-Alpes']);
        Region::create(['name' => 'Bourgogne-Franche-Comté']);
        Region::create(['name' => 'Bretagne']);
        Region::create(['name' => 'Centre-Val de Loire']);
        Region::create(['name' => 'Corse']);
        Region::create(['name' => 'Grand-Est']);
        Region::create(['name' => 'Hauts-de-France']);
        Region::create(['name' => 'Île-de-France']);
        Region::create(['name' => 'Normandie']);
        Region::create(['name' => 'Nouvelle-Aquitaine']);
        Region::create(['name' => 'Occitanie']);
        Region::create(['name' => 'Pays de la Loire']);
        Region::create(['name' => "Provence-Alpes-Côte d'Azur"]);
        Region::create(['name' => 'Guadeloupe']);
        Region::create(['name' => 'Guyane (française)']);
        Region::create(['name' => 'Martinique']);
        Region::create(['name' => 'La Réunion']);
        Region::create(['name' => 'Mayotte']);
    }
}

class LevelTableSeeder extends Seeder
{
    /**
     * Seed the region's table.
     *
     * @return void
     */
    public function run()
    {
        Level::create(['name' => 'Assistant-formateur']);
        Level::create(['name' => 'Formateur']);
        Level::create(['name' => 'Instructeur']);
        Level::create(['name' => 'Directeur de cours']);
    }
}

class TrainerTableSeeder extends Seeder
{
    /**
     * Seed the user's table.
     *
     * @return void
     */
    public function run()
    {
        Trainer::create(
          [
            'first_name' => 'Mélodie',
            'last_name' => 'Célimène',
            'email' => 'm@m.fr',
            'level_id' => 2,
            'region_id' => 2
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Lucie',
            'last_name' => 'Célimène',
            'email' => 'l@m.fr',
            'level_id' => 4,
            'region_id' => 5
          ]
        );
        Trainer::create(
          [
            'first_name' => 'Toto',
            'last_name' => 'Tata',
            'email' => 'toto@tata.fr',
            'level_id' => 4,
            'region_id' => 2
          ]
        );
    }
}
